<?php

use Illuminate\Database\Seeder;
use GMC\Models\Interest;

class InterestSeeder extends Seeder {

    public function run() {
        DB::statement("SET foreign_key_checks=0");
        Interest::truncate();
        DB::statement("SET foreign_key_checks=1");
        $seeds = '[{"interestSubFrom":"0","interestName":"Artis\/Selebritis","interestParent":null},{"interestSubFrom":"0","interestName":"Audio Video","interestParent":null},{"interestSubFrom":"0","interestName":"Aviasi\/kedirgantaraan & militer","interestParent":null},{"interestSubFrom":"0","interestName":"Bisnis & ekonomi","interestParent":null},{"interestSubFrom":"0","interestName":"Dongeng","interestParent":null},{"interestSubFrom":"0","interestName":"Enterpreneurship","interestParent":null},{"interestSubFrom":"0","interestName":"Fashion","interestParent":null},{"interestSubFrom":"0","interestName":"Fauna","interestParent":null},{"interestSubFrom":"0","interestName":"Flora\/Gardening","interestParent":null},{"interestSubFrom":"0","interestName":"Fotografi, Videografi","interestParent":null},{"interestSubFrom":"0","interestName":"Gadget & Selular","interestParent":null},{"interestSubFrom":"0","interestName":"Game","interestParent":null},{"interestSubFrom":"0","interestName":"Handycraft (Ketrampilan Tangan)","interestParent":null},{"interestSubFrom":"0","interestName":"IT & Komputer","interestParent":null},{"interestSubFrom":"0","interestName":"Karir","interestParent":null},{"interestSubFrom":"0","interestName":"Kecantikan","interestParent":null},{"interestSubFrom":"0","interestName":"Kesehatan","interestParent":null},{"interestSubFrom":"0","interestName":"Kuliner","interestParent":null},{"interestSubFrom":"0","interestName":"Living","interestParent":null},{"interestSubFrom":"0","interestName":"Memasak","interestParent":null},{"interestSubFrom":"0","interestName":"Musik","interestParent":null},{"interestSubFrom":"0","interestName":"Olah raga","interestParent":null},{"interestSubFrom":"0","interestName":"Otomotif","interestParent":null},{"interestSubFrom":"0","interestName":"Parenting","interestParent":null},{"interestSubFrom":"0","interestName":"Pengetahuan umum","interestParent":null},{"interestSubFrom":"0","interestName":"Rumah, renovasi","interestParent":null},{"interestSubFrom":"0","interestName":"Sains","interestParent":null},{"interestSubFrom":"0","interestName":"Sepeda","interestParent":null},{"interestSubFrom":"0","interestName":"Traveling","interestParent":null},{"interestSubFrom":"0","interestName":"Lainnya*","interestParent":null},{"interestSubFrom":"23","interestName":"Modifikasi Mobil","interestParent":"Otomotif"},{"interestSubFrom":"23","interestName":"Modifikasi Motor","interestParent":"Otomotif"},{"interestSubFrom":"23","interestName":"Sport Mobil","interestParent":"Otomotif"},{"interestSubFrom":"23","interestName":"Sport Motor","interestParent":"Otomotif"},{"interestSubFrom":"23","interestName":"Touring Mobil","interestParent":"Otomotif"},{"interestSubFrom":"23","interestName":"Touring Motor","interestParent":"Otomotif"}]';
        foreach (json_decode($seeds) as $row) :
            $seed = collect($row);
            $seed->pull('interestParent');
            Interest::create($seed->toArray());
        endforeach;
    }

}
