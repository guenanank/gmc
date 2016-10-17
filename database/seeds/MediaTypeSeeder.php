<?php

use Illuminate\Database\Seeder;
use App\MediaType;

class MediaTypeSeeder extends Seeder {

    public function run() {
        DB::statement("SET foreign_key_checks=0");
        MediaType::truncate();
        DB::statement("SET foreign_key_checks=1");
        $seeds = '[{"mediaTypeName":"Tabloid"},{"mediaTypeName":"Magazine"},{"mediaTypeName":"Digital"}]';
        foreach (json_decode($seeds) as $row) :
            $seed = collect($row)->toArray();
            MediaType::create($seed);
        endforeach;
    }

}
