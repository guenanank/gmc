<?php

namespace GMC\Http\Controllers;

use GMC\Services\Facades\Master;

class Vehicle extends Controller {

    protected $vehicle;

    public function __construct() {
        $this->vehicle = Master::get('Vehicles.types');
    }

    public function index(\Illuminate\Http\Request $request) {
        $bootgrid = $this->vehicle->target . '/bootgrid?token=' . $request->session()->get('api_token');
        return view('vendor.materialAdmin.masters.vehicle.index', compact('bootgrid'));
    }

}
