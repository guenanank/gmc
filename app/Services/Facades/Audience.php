<?php

namespace GMC\Services\Facades;

use Illuminate\Support\Facades\Facade;

class Audience extends Facade {

    protected static function getFacadeAccessor() {
        return '\GMC\Services\Containers\Audience';
    }

}
