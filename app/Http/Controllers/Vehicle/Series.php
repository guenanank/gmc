<?php

namespace GMC\Http\Controllers\Vehicle;

use GMC\Http\Controllers\Controller;
use GMC\Services\Facades\Vehicle;

class Series extends Controller {

    protected $series;

    public function __construct() {
        $this->series = Vehicle::get('series');
    }

    public function index() {
        $bootgrid = $this->series->target . 'bootgrid';
        return view('masters.vehicle.series.index', compact('bootgrid'));
    }

}
