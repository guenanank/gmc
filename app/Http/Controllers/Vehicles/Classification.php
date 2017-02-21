<?php

namespace GMC\Http\Controllers\Vehicles;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GMC\Http\Requests;

class Classification extends \GMC\Http\Controllers\Controller {

    public $request;
    public $client;
    public $classification;

    public function __construct(Request $request, Client $client) {
        $this->request = $request;
        $this->client = $client;

        $this->classification = config('api.target') . '/' . config('api.version') . '/vehicle/classification';
    }

    public function index() {
        $target = $this->classification;
        return view('vendor.materialAdmin.vehicles.classification.index', compact('target'));
    }

    public function create() {
        $target = $this->classification;
        return view('vendor.materialAdmin.vehicles.classification.create', compact('target'));
    }

    public function edit($id) {
        $target = $this->classification;
        $getClassification = $this->client->get($target . '/' . $id, [
            'query' => ['token' => $this->request->session()->get('api_token')]
        ]);

        $classification = json_decode($getClassification->getBody());
        return view('vendor.materialAdmin.vehicles.classification.edit', compact('target', 'classification'));
    }

}
