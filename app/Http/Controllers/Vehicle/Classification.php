<?php

namespace GMC\Http\Controllers\Vehicle;

use GMC\Http\Controllers\Controller;
use GMC\Services\Facades\Vehicle;

class Classification extends Controller {

    protected $classification;

    public function __construct() {
        $this->classification = Vehicle::get('classifications');
    }

    public function index() {
        $bootgrid = $this->classification->target . 'bootgrid';
        return view('masters.vehicle.classification.index', compact('bootgrid'));
    }

}
