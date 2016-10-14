<?php

namespace GMC\Http\Controllers\Residence;

use GMC\Http\Controllers\Controller;
use GMC\Services\Facades\Residence;

class District extends Controller {

    protected $district;

    public function __construct() {
        $this->district = Residence::get('districts');
    }

    public function index() {
        $bootgrid = $this->district->target . 'bootgrid';
        return view('masters.residence.district.index', compact('bootgrid'));
    }

}
