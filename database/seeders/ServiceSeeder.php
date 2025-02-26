<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->serviceService()->create('Administratif', '1', 'Service administratif');
        $this->serviceService()->create('Direction', '2', 'Service de direction');
        $this->serviceService()->create('Coordination', '3', 'Service de coordination');
    }
}
