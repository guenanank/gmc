<?php

namespace GMC\Http\Controllers\Vehicle;

use Illuminate\Http\Request;
use GMC\Http\Requests;
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

    public function create() {
        $route = $this->type->target . 'store';
        return view('masters.vehicle.type.create', compact('route'));
    }
    
    public function edit($id) {
        $type = $id;
        $url = $this->type->target . '/' . $id;
        return view('masters.vehicle.type.edit', compact('url', 'type'));
    }

}
