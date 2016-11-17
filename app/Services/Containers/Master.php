<?php

namespace GMC\Services\Containers;

use Illuminate\Container\Container;
use GMC\Models\Master as MasterModel;

class Master extends Container {

    protected $masterRepo;
    protected $master;

    public function __construct(MasterModel $master) {
        $this->masterRepo = $master->all()->pluck('masterFormat', 'masterName');
    }

    public function get($name) {
        $name = collect(explode('.', $name));
        $master = $this->masterRepo->get($name[0]);
        $this->master = ($name->count() > 1) ? $master->where('name', $name[1]) : $master;
        return $this->master->first();
    }

    public function target($target) {
        $this->get()->target = $target;
    }

}
