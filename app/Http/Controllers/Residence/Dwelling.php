<?php

namespace GMC\Http\Controllers\Residence;

use GMC\Http\Controllers\Controller;
use GMC\Services\Facades\Residence;

class Dwelling extends Controller {

    protected $dwelling;

    public function __construct() {
        $this->dwelling = Residence::get('dwellings');
    }

    public function index() {
        $bootgrid = $this->dwelling->target . 'bootgrid';
        return view('masters.residence.dwelling.index', compact('bootgrid'));
    }

}
