<?php

namespace GMC\Http\Controllers\Residence;

use GMC\Http\Controllers\Controller;
use GMC\Services\Facades\Residence;

class GreaterArea extends Controller {

    protected $greaterArea;

    public function __construct() {
        $this->greaterArea = Residence::get('greaterAreas');
    }

    public function index() {
        $bootgrid = $this->greaterArea->target . 'bootgrid';
        return view('masters.residence.greaterArea.index', compact('bootgrid'));
    }

}
