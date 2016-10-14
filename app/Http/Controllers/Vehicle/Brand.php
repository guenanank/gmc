<?php

namespace GMC\Http\Controllers\Vehicle;

use GMC\Http\Controllers\Controller;
use GMC\Services\Facades\Vehicle;

class Brand extends Controller {
    protected $brand;

    public function __construct() {
        $this->brand = Vehicle::get('brands');
    }

    public function index() {
        $bootgrid = $this->brand->target . 'bootgrid';
        return view('masters.vehicle.brand.index', compact('bootgrid'));
    }
}
