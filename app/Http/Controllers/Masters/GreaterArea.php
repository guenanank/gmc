<?php

namespace GMC\Http\Controllers\Masters;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GMC\Http\Requests;
use GMC\Services\Facades\Master;

class GreaterArea extends \GMC\Http\Controllers\Controller {

    public $greaterArea;
    public $request;
    public $client;
    public $regency;

    public function __construct(Request $request, Client $client) {
        $this->greaterArea = config('api.target') . '/' . config('api.version') . '/region/greaterArea';
        $this->request = $request;
        $this->client = $client;
        $this->regency = config('api.target') . '/' . config('api.version') . '/region/regency';
    }

    public function index() {
        $target = $this->greaterArea;
        return view('vendor.materialAdmin.masters.greaterArea.index', compact('target'));
    }

    public function create() {
        $target = $this->greaterArea;
        $request = $this->client->options($this->regency . '/lists', [
            'query' => ['token' => $this->request->session()->get('api_token')]
        ]);
        $regencies = json_decode($request->getBody());

        return view('vendor.materialAdmin.masters.greaterArea.create', compact('target', 'regencies'));
    }

    public function edit($id) {
        $target = $this->greaterArea;
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
