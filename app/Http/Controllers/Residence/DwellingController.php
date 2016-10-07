<?php

namespace GMC\Http\Controllers\Residence;

use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Http\Controllers\Controller;
use GMC\Services\Facades\Residence;

class DwellingController extends Controller {

    protected $dwelling;

    public function __construct() {
        $this->dwelling = Residence::get('dwellings');
    }

    public function index() {
        $bootgrid = $this->dwelling->target . '/bootgrid';
        return view('masters.residence.dwelling.index', compact('bootgrid'));
    }

    public function create() {
        $route = $this->dwelling->target . '/store';
        return view('masters.residence.dwelling.create', compact('route'));
    }

    public function edit($id) {
        $dwelling = $id;
        $url = $this->dwelling->target . '/' . $id;
        return view('masters.residence.dwelling.edit', compact('url', 'dwelling'));
    }

}
