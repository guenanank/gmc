<?php

namespace GMC\Http\Controllers\Vehicles;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GMC\Http\Requests;

class Type extends \GMC\Http\Controllers\Controller {

    public $request;
    public $client;
    public $types;
    public $series;

    public function __construct(Request $request, Client $client) {
        $this->request = $request;
        $this->client = $client;

        $this->types = config('api.target') . '/' . config('api.version') . '/vehicle/type';

        $getSeries = $this->client->options(config('api.target') . '/' . config('api.version') . '/vehicle/series/lists', [
            'query' => ['token' => $this->request->session()->get('api_token')]
        ]);
        $this->series = json_decode($getSeries->getBody());
    }

    public function index() {
        $target = $this->types;
        return view('vendor.materialAdmin.vehicles.type.index', compact('target'));
    }

    public function create() {
        $target = $this->types;
        $series = $this->series;
        return view('vendor.materialAdmin.vehicles.type.create', compact('target', 'series'));
    }

    public function edit($id) {
        $target = $this->types;
        $series = $this->series;

        $getTypes = $this->client->get($target . '/' . $id, [
            'query' => ['token' => $this->request->session()->get('api_token')]
        ]);

        $type = json_decode($getTypes->getBody());
        return view('vendor.materialAdmin.vehicles.type.edit', compact('type', 'target', 'series'));
    }

}
