<?php

namespace GMC\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Services\Facades\Master;

class GreaterArea extends Controller {

    public $greaterArea;
    public $request;
    public $client;
    public $regency;

    public function __construct(Request $request, Client $client) {
        $this->greaterArea = Master::get('Region.greaterAreas');
        $this->request = $request;
        $this->client = $client;
        $this->regency = 'https://api.gramedia-majalah.com/v1/region/regency';
    }

    public function index() {
        $target = $this->greaterArea->target;
        return view('vendor.materialAdmin.masters.greaterArea.index', compact('target'));
    }

    public function create() {
        $target = $this->greaterArea->target;
        $request = $this->client->options($this->regency . '/lists', [
            'query' => ['token' => $this->request->session()->get('api_token')]
        ]);
        $regencies = json_decode($request->getBody());

        return view('vendor.materialAdmin.masters.greaterArea.create', compact('target', 'regencies'));
    }

    public function edit($id) {
        $target = $this->greaterArea->target;
        $getGeaterArea = $this->client->get($target . '/' . $id, [
            'query' => ['token' => $this->request->session()->get('api_token')]
        ]);

        $greaterArea = json_decode($getGeaterArea->getBody());
        $getRegencies = $this->client->options($this->regency . '/lists', [
            'query' => ['token' => $this->request->session()->get('api_token')]
        ]);

        $regencies = json_decode($getRegencies->getBody());

        return view('vendor.materialAdmin.masters.greaterArea.edit', compact('target', 'greaterArea', 'regencies'));
    }

}
