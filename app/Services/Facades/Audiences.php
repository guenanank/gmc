<?php

namespace GMC\Services\Facades;

use Illuminate\Support\Facades\Facade;

class Audiences extends Facade {

    protected static function getFacadeAccessor() {
        return '\GMC\Services\Containers\Audiences';
    }

}
