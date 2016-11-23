<?php

namespace GMC\Http\Controllers;

use GMC\Services\Facades\Master;

class Media extends Controller {

    public $media;
    public $target;
    
    public function __construct() {
        $this->media = Master::get('Media');
        $this->target = $this->media->target;
    }

    public function index() {
        //$target = $this->target;
        $target = 'http://localhost/api/public/v1/gateway/media';
        return view('vendor.materialAdmin.masters.media.index', compact('target'));
    }

}
