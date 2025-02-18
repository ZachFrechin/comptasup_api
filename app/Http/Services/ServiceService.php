<?php

namespace App\Http\Services;

use App\Models\NoteHistory;
use App\Http\Services\Service;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Service as ServiceModel;

class ServiceService extends Service
{
    public function create(string $name, string $numeron, string $description) : ServiceModel
    {
        return ServiceModel::create(
            [
                'nom' => $name,
                'numero' => $numeron,
                'description' => $description,
            ]
        );
    }

    public function getByName(string $name) : ServiceModel | null
    {
        return ServiceModel::where(['nom' => $name])->first();
    }
}
