<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Storage;

use App\Http\Services\Service;

use App\Traits\ServiceCallable;

class IndemniteKilometriqueService extends Service
{

    use ServiceCallable;

    public function store(array $data)
    {
        $jsonContent = json_encode($data);
        Storage::disk('public')->put('indemnite.json', $jsonContent);
    }

    public function retrieve()
    {
        $jsonContent = Storage::disk('public')->get('indemnite.json');
        return json_decode($jsonContent, true);
    }
  
}
