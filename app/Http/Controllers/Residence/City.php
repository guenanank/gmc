<?php

namespace GMC\Http\Controllers\Residence;

use GMC\Http\Controllers\Controller;
use GMC\Services\Facades\Residence;

class City extends Controller {

    protected $city;

    public function __construct() {
        $this->city = Residence::get('cities');
    }

    public function index() {
        $bootgrid = $this->city->target . 'bootgrid';
        return view('masters.residence.city.index', compact('bootgrid'));
    }

}
