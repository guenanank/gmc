<?php

namespace GMC\Http\Controllers;

use Illuminate\Http\Request;
use GMC\Http\Requests;

class Dashboard extends Controller {

    public function index() {
        return view('dashboard.index');
    }

}
