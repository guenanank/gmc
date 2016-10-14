<?php

namespace GMC\Http\Controllers\Residence;

use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Http\Controllers\Controller;
use GMC\Services\Facades\Residence;

class CountryController extends Controller {

    protected $country;
    
    public function __construct() {
        $this->country = Residence::get('countries');
    }

    public function index() {
        $bootgrid = $this->country->target . 'bootgrid';
        return view('masters.residence.country.index', compact('bootgrid'));
    }

    public function create() {
        $route = $this->country->target . 'store';
        return view('masters.residence.country.create', compact('route'));
    }
    
    public function edit($id) {
        $country = $id;
        $url = $this->country->target . '/' . $id;
        return view('masters.residence.country.edit', compact('url', 'country'));
    }

}
