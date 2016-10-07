<?php

use Illuminate\Database\Seeder;
use App\Education;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        Education::truncate();
        DB::statement("SET foreign_key_checks=1");
        $seeds = '[{"educationName":"Sekolah Dasar"},{"educationName":"Sekolah Menengah Pertama"},{"educationName":"Sekolah Menengah Akhir"},{"educationName":"Diploma"},{"educationName":"Sarjana"},{"educationName":"Magister"},{"educationName":"Doktoral"},{"educationName":"Lainnya"}]';
        foreach(json_decode($seeds) as $row) :
            $seed = collect($row)->toArray();
            Education::create($seed);
        endforeach;
    }
}
