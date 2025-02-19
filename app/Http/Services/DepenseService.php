<?php

namespace App\Http\Services;

use App\Models\NoteHistory;
use App\Http\Services\Service;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\Depense\DepenseCreateRequest;
use App\Models\Depense;
use App\Traits\ServiceCallable;

class DepenseService extends Service
{

    use ServiceCallable;

    public function __construct()
    {
        $this->registerServices([
            'natureService' => NatureService::class,
        ]);
    }

    public function create(array $fields) : Depense
    {
        return Depense::create($fields);
    }

    public function getAll() : Collection
    {
        return Depense::all();
    }
    
    public function storeFile(Depense $depense, DepenseCreateRequest $request) : void
    {
        $nature = $this->natureService()->findByID(id: $depense->nature_id);
        $details = json_decode($depense->details, true);
        foreach ($nature->descriptor as $field => $descriptor) {
            if ($descriptor['type'] === 'file' && $request->hasFile($field)) {
                $name = $details[$field];
                $request->file($field)->storeAs('public/depenses/'.$depense->id, $field);
            }
        }
    }

    public function getFile(Depense $depense, string $filename) : string | null
    {
        $filePath = storage_path("app/private/public/depenses/{$depense->id}/{$filename}");
        if (file_exists(filename: $filePath)) {
            return $filePath;
        } else {
            return null;
        }
    }

    public function update(Depense $depense, array $fields) : Depense
    {
        $depense->update($fields);
        return $depense;
    }
  
}
