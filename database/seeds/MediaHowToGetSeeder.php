<?php

use Illuminate\Database\Seeder;

class MediaHowToGetSeeder extends Seeder {

    public function run() {
        DB::statement("SET foreign_key_checks=0");
        DB::table('mediaHowToGet')->truncate();
        DB::statement("SET foreign_key_checks=1");
        $seeds = '[{"mediaHowToGetName":"Subscriber"},{"mediaHowToGetName":"Retail (Routines)"},{"mediaHowToGetName":"Retail (Sometimes)"},{"mediaHowToGetName":"Borrow"}]';
        foreach (json_decode($seeds) as $row) :
            $seed = collect($row)->toArray();
            DB::table('mediaHowToGet')->insert($seed);
        endforeach;
    }

}
