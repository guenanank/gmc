<?php

namespace GMC\Services\Facades;

use Illuminate\Support\Facades\Facade;

class AudienceFacade extends Facade
{
    protected static function getFacadeAccessor() 
    {
        return 'AudienceContainer';
    }
}