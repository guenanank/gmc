<?php

namespace GMC\Http\Controllers\Residence;

use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Http\Controllers\Controller;
use GMC\Services\Facades\Residence;

class ProvinceController extends Controller {
    
    protected $province;
    
    public function __construct() {
        $this->province = Residence::get('provinces');
    }

    public function index() {
        $bootgrid = $this->province->target . '/bootgrid';
        return view('masters.residence.province.index', compact('bootgrid'));
    }

    public function create() {
        $route = $this->province->target . '/store';
        return view('masters.residence.province.create', compact('route'));
    }
    
    public function edit($id) {
        $province = $id;
        $url = $this->province->target . '/' . $id;
        return view('masters.residence.province.edit', compact('url', 'province'));
    }
}
