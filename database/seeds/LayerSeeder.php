<?php

use Illuminate\Database\Seeder;
use GMC\Models\Layer;

class LayerSeeder extends Seeder {

    public function run() {
        DB::statement("SET foreign_key_checks=0");
        Layer::truncate();
        DB::statement("SET foreign_key_checks=1");
        $seeds = '[{"layerName":"Biography","layerDesc":""},{"layerName":"Family","layerDesc":""},{"layerName":"Media Habit","layerDesc":""},{"layerName":"Automotive","layerDesc":""}]';
        foreach (json_decode($seeds) as $row) :
            $seed = collect($row);
            Layer::create($seed->toArray());
        endforeach;
    }

}
