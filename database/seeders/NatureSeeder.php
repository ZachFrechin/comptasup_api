<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NatureSeeder extends DatabaseSeeder
{
    public function run() : void
    {
        $directory = __DIR__ . '/NatureJSON';
        $files = scandir($directory);

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                $filePath = $directory . '/' . $file;
                $fileContent = file_get_contents($filePath);
                
                $data = json_decode($fileContent, true);
            
                if ($data !== null) {
                    $this->natureService()->create($data['nom'], $data['numero'], json_encode($data['descriptor']));
                } else {
                    echo "Erreur de décodage JSON pour le fichier: $file\n";
                }
            }
        }
    }
}