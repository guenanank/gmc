<?php

namespace GMC\Services\Containers;

use Illuminate\Container\Container;

class Vehicle extends Container {

    protected $master;
    protected $key;
    protected $target;

    public function __construct(\GMC\Models\Master $master) {
        $this->master = $master->findOrFail(11);
    }
    
    public function get($name = null) {
        $API = $this->master->masterFormat->where('name', $name)->first()->useAPI;
        $this->key = $API->key;
        $this->target = $API->target;
        return $API;
    }

    public function key($key) {
        $this->key = $key;
    }

    public function target($target) {
        $this->target = $target;
    }

}
