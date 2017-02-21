<?php

namespace GMC\Http\Controllers\Vehicles;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GMC\Http\Requests;

class Brand extends \GMC\Http\Controllers\Controller {

    public $request;
    public $client;
    public $brand;

    public function __construct(Request $request, Client $client) {
        $this->request = $request;
        $this->client = $client;

        $this->brand = config('api.target') . '/' . config('api.version') . '/vehicle/brand';
    }

    public function index() {
        $target = $this->brand;
        return view('vendor.materialAdmin.vehicles.brand.index', compact('target'));
    }

    public function create() {
        $target = $this->brand;
        return view('vendor.materialAdmin.vehicles.brand.create', compact('target'));
    }

    public function edit($id) {
        $target = $this->brand;
        $getBrand = $this->client->get($target . '/' . $id, [
            'query' => ['token' => $this->request->session()->get('api_token')]
        ]);

        $brand = json_decode($getBrand->getBody());
        return view('vendor.materialAdmin.vehicles.brand.edit', compact('target', 'brand'));
    }

}
