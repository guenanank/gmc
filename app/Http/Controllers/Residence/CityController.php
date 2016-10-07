<?php

namespace GMC\Http\Controllers\Residence;

use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Http\Controllers\Controller;
use GMC\Services\Facades\Residence;

class CityController extends Controller {

    protected $city;

    public function __construct() {
        $this->city = Residence::get('cities');
    }

    public function index() {
        $bootgrid = $this->city->target . '/bootgrid';
        return view('masters.residence.city.index', compact('bootgrid'));
    }

    public function create() {
        $route = $this->city->target . '/store';
        return view('masters.residence.city.create', compact('route'));
    }

    public function edit($id) {
        $city = $id;
        $url = $this->city->target . '/' . $id;
        return view('masters.residence.city.edit', compact('url', 'city'));
    }

}
