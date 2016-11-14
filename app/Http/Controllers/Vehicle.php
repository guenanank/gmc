<?php

namespace GMC\Http\Controllers;

use GMC\Services\Facades\Vehicle as Vehicles;

class Vehicle extends Controller {

    protected $type;

    public function __construct() {
        $this->type = Vehicles::get('types');
    }

    public function index(\Illuminate\Http\Request $request) {
        $bootgrid = $this->type->target . 'bootgrid?token=' . $request->session()->get('api_token');
        return view('vendor.materialAdmin.masters.vehicle.index', compact('bootgrid'));
    }

}
