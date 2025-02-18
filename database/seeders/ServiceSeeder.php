<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->serviceService()->create('Comptabilité', '1', 'Service de comptabilité');
        $this->serviceService()->create('Management', '2', 'Service de management');
    }
}