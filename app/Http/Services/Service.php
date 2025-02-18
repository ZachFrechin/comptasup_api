<?php

namespace App\Http\Services;

use App\Traits\ServiceCallable;
abstract class Service
{
    use ServiceCallable;

    public function __construct() 
    {
        $this->registerServices([
            'natureService' => NatureService::class,
        ]);
    }
}
