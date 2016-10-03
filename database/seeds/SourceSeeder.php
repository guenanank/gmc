<?php

use Illuminate\Database\Seeder;
use App\Source;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        Source::truncate();
        DB::statement("SET foreign_key_checks=1");
        $seeds = '[{"sourceName":"APPS DOWNLOADER"},{"sourceName":"DATABASE GMC"},{"sourceName":"E-MAGZ READERS & DOWNLOADER"},{"sourceName":"EXTERNAL EVENT"},{"sourceName":"INTERNAL EVENT"},{"sourceName":"KLUB MEMBERSHIP"},{"sourceName":"KUIS"},{"sourceName":"MEDIA RELATIONS"},{"sourceName":"PELANGGAN SKG"},{"sourceName":"SMS"},{"sourceName":"SURAT PEMBACA"},{"sourceName":"SURVEY"},{"sourceName":"WEB VISITORS"}]';
        foreach(json_decode($seeds) as $row) :
            $seed = collect($row)->toArray();
            Source::create($seed);
        endforeach;
    }
}
