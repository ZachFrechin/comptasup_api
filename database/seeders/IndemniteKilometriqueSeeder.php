<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class IndemniteKilometriqueSeeder extends DatabaseSeeder
{
    public function run()
    {
        $sourcePath = database_path('seeders/UtilsJSON/indemnite.json');
        $destinationPath = storage_path('app/public/indemnite.json');
        
        // Copie le fichier
        File::copy($sourcePath, $destinationPath);
    }
}