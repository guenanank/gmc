<?php

namespace GMC\Http\Controllers\Residence;

use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Http\Controllers\Controller;
use GMC\Services\Facades\Residence;

class GreaterAreaController extends Controller {

    protected $greaterArea;

    public function __construct() {
        $this->greaterArea = Residence::get('greaterArea');
    }

    public function index() {
        $bootgrid = $this->greaterArea->target . '/bootgrid';
        return view('masters.residence.greaterArea.index', compact('bootgrid'));
    }

    public function create() {
        $route = $this->greaterArea->target . '/store';
        return view('masters.residence.greaterArea.create', compact('route'));
    }

    public function edit($id) {
        $greaterArea = $id;
        $url = $this->greaterArea->target . '/' . $id;
        return view('masters.residence.greaterArea.edit', compact('url', 'greaterArea'));
    }

}
