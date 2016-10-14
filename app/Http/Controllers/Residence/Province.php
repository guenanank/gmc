<?php

namespace GMC\Http\Controllers\Residence;

use GMC\Http\Controllers\Controller;
use GMC\Services\Facades\Residence;

class Province extends Controller {

    protected $province;

    public function __construct() {
        $this->province = Residence::get('provinces');
    }

    public function index() {
        $bootgrid = $this->province->target . 'bootgrid';
        return view('masters.residence.province.index', compact('bootgrid'));
    }

}
