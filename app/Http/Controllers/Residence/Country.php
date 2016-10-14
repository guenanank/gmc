<?php

namespace GMC\Http\Controllers\Residence;

use GMC\Http\Controllers\Controller;
use GMC\Services\Facades\Residence;

class Country extends Controller {

    protected $country;
    
    public function __construct() {
        $this->country = Residence::get('countries');
    }

    public function index() {
        $bootgrid = $this->country->target . 'bootgrid';
        return view('masters.residence.country.index', compact('bootgrid'));
    }

}
