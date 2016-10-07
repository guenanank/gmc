<?php

namespace GMC\Http\Controllers\Vehicle;

use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Http\Controllers\Controller;
use GMC\Services\Facades\Vehicle;

class BrandController extends Controller {

    protected $brand;
    
    public function __construct() {
        $this->brand = Vehicle::get('brands');
    }

    public function index() {
        $bootgrid = $this->brand->target . '/bootgrid';
        return view('masters.vehicle.brand.index', compact('bootgrid'));
    }

    public function create() {
        $route = $this->brand->target . '/store';
        return view('masters.vehicle.brand.create', compact('route'));
    }
    
    public function edit($id) {
        $brand = $id;
        $url = $this->brand->target . '/' . $id;
        return view('masters.vehicle.brand.edit', compact('url', 'brand'));
    }

}
