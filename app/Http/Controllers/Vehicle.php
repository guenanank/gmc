<?php

namespace GMC\Http\Controllers;

use GMC\Services\Facades\Vehicle as Vehicles;

class Vehicle extends Controller {

    protected $type;

    public function __construct() {
        $this->type = Vehicles::get('types');
    }

    public function index() {
        $bootgrid = $this->type->target . 'bootgrid';
        return view('vendor.materialAdmin.masters.vehicle.index', compact('bootgrid'));
    }

}
