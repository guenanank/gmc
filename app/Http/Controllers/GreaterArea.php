<?php

namespace GMC\Http\Controllers;

use GMC\Services\Facades\Master;

class GreaterArea extends Controller {

    public $greaterArea;
    
    public function __construct() {
        $this->greaterArea = Master::get('Regions.greaterAreas');
    }

    public function index(\Illuminate\Http\Request $request) {
        $bootgrid = $this->greaterArea->target . '/bootgrid?token=' . $request->session()->get('api_token');
        return view('vendor.materialAdmin.masters.greaterArea.index', compact('bootgrid'));
    }

}
