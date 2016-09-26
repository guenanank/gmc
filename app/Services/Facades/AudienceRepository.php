<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class AudienceRepository extends Facade
{
    protected static function getFacadeAccessor() 
    {
        return 'AudienceRepository';
    }
}