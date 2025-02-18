<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EtatSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->etatService()->create('not validated');
        $this->etatService()->create('rejected');
        $this->etatService()->create('canceled');
        $this->etatService()->create('not_controled');
        $this->etatService()->create('validated');
        $this->etatService()->create('archived');
    }
}