<?php

namespace GMC\Http\Controllers\Vehicles;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GMC\Http\Requests;

class Series extends \GMC\Http\Controllers\Controller {

    public $request;
    public $client;
    public $series;
    public $classifications;
    public $brands;

    public function __construct(Request $request, Client $client) {
        $this->request = $request;
        $this->client = $client;

        $this->series = config('api.target') . '/' . config('api.version') . '/vehicle/series';

        $getBrand = $this->client->options(config('api.target') . '/' . config('api.version') . '/vehicle/brand/lists', [
            'query' => ['token' => $this->request->session()->get('api_token')]
        ]);
        $this->brands = json_decode($getBrand->getBody());

        $getClassification = $this->client->options(config('api.target') . '/' . config('api.version') . '/vehicle/classification/lists', [
            'query' => ['token' => $this->request->session()->get('api_token')]
        ]);
        $this->classifications = json_decode($getClassification->getBody());
    }

    public function index() {
        $target = $this->series;
        return view('vendor.materialAdmin.vehicles.series.index', compact('target'));
    }

    public function create() {
        $target = $this->series;
        $brands = $this->brands;
        $classifications = $this->classifications;
        return view('vendor.materialAdmin.vehicles.series.create', compact('target', 'brands', 'classifications'));
    }

    public function edit($id) {
        $target = $this->series;
        $brands = $this->brands;
        $classifications = $this->classifications;

        $getSeries = $this->client->get($target . '/' . $id, [
            'query' => ['token' => $this->request->session()->get('api_token')]
        ]);

        $series = json_decode($getSeries->getBody());
        return view('vendor.materialAdmin.vehicles.series.edit', compact('series', 'target', 'brands', 'classifications'));
    }

}
