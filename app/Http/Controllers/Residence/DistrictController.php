<?php

namespace GMC\Http\Controllers\Residence;

use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Http\Controllers\Controller;
use GMC\Services\Facades\Residence;

class DistrictController extends Controller {

    protected $district;

    public function __construct() {
        $this->district = Residence::get('districts');
    }

    public function index() {
        $bootgrid = $this->district->target . 'bootgrid';
        return view('masters.residence.district.index', compact('bootgrid'));
    }

    public function create() {
        $route = $this->district->target . 'store';
        return view('masters.residence.district.create', compact('route'));
    }

    public function edit($id) {
        $district = $id;
        $url = $this->district->target . '/' . $id;
        return view('masters.residence.district.edit', compact('url', 'district'));
    }

}
