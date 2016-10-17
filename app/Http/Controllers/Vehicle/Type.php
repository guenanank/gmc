<?php

namespace GMC\Http\Controllers\Vehicle;

use GMC\Http\Controllers\Controller;
use GMC\Services\Facades\Vehicle;

class Type extends Controller {

    protected $type;

    public function __construct() {
        $this->type = Vehicle::get('types');
    }

    public function index() {
        $bootgrid = $this->type->target . 'bootgrid';
        return view('masters.vehicle.type.index', compact('bootgrid'));
    }

}
