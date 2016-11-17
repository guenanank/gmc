<?php

namespace GMC\Services\Facades;

use Illuminate\Support\Facades\Facade;

class Master extends Facade {

    protected static function getFacadeAccessor() {
        return '\GMC\Services\Containers\Master';
    }

}
