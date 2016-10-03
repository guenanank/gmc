<?php

use Illuminate\Database\Seeder;
use App\Hobby;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        Hobby::truncate();
        DB::statement("SET foreign_key_checks=1");
        $seeds = '[{"hobbySubFrom":"0","hobbyName":"Belanja\/Shopping","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Berinternet","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Berkebun\/ Bertanam\/ Gardening","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Computing","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Fotografi","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Handycraft (Ketrampilan Tangan)","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Jalan-Jalan","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Main Alat Musik (Gitar\/Drum\/Piano\/ dll)","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Main games","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Memasak","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Membaca","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Memelihara binatang","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Menari","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Mendengarkan Musik","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Menggambar \/ Melukis","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Menulis","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Menyanyi","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Nonton Film","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Nonton Konser","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Olahraga","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Otomotif","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Sains & teknologi","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Sepeda","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Traveling","hobbyParent":null},{"hobbySubFrom":"2","hobbyName":"Blogging\/Menulis blog","hobbyParent":"Berinternet"},{"hobbySubFrom":"2","hobbyName":"Googling\/Browsing\/ dll","hobbyParent":"Berinternet"},{"hobbySubFrom":"2","hobbyName":"Social media","hobbyParent":"Berinternet"},{"hobbySubFrom":"11","hobbyName":"Buku\/Novel","hobbyParent":"Membaca"},{"hobbySubFrom":"11","hobbyName":"Komik","hobbyParent":"Membaca"},{"hobbySubFrom":"11","hobbyName":"Koran","hobbyParent":"Membaca"},{"hobbySubFrom":"11","hobbyName":"Majalah\/Tabloid","hobbyParent":"Membaca"},{"hobbySubFrom":"20","hobbyName":"Basket","hobbyParent":"Olahraga"},{"hobbySubFrom":"20","hobbyName":"Fitness\/Gym","hobbyParent":"Olahraga"},{"hobbySubFrom":"20","hobbyName":"Lari\/Joging","hobbyParent":"Olahraga"},{"hobbySubFrom":"20","hobbyName":"Renang","hobbyParent":"Olahraga"},{"hobbySubFrom":"20","hobbyName":"Sepakbola\/Futsal","hobbyParent":"Olahraga"},{"hobbySubFrom":"21","hobbyName":"Modifikasi Mobil","hobbyParent":"Otomotif"},{"hobbySubFrom":"21","hobbyName":"Modifikasi Motor","hobbyParent":"Otomotif"},{"hobbySubFrom":"21","hobbyName":"Sport Mobil","hobbyParent":"Otomotif"},{"hobbySubFrom":"21","hobbyName":"Sport Motor","hobbyParent":"Otomotif"},{"hobbySubFrom":"21","hobbyName":"Touring Mobil","hobbyParent":"Otomotif"},{"hobbySubFrom":"21","hobbyName":"Touring Motor","hobbyParent":"Otomotif"},{"hobbySubFrom":"0","hobbyName":"Lainnya","hobbyParent":null},{"hobbySubFrom":"20","hobbyName":"Badminton","hobbyParent":"Olahraga"},{"hobbySubFrom":"20","hobbyName":"Baseball","hobbyParent":"Olahraga"},{"hobbySubFrom":"20","hobbyName":"Bela Diri","hobbyParent":"Olahraga"},{"hobbySubFrom":"20","hobbyName":"Billiard","hobbyParent":"Olahraga"},{"hobbySubFrom":"20","hobbyName":"Catur","hobbyParent":"Olahraga"},{"hobbySubFrom":"20","hobbyName":"Golf","hobbyParent":"Olahraga"},{"hobbySubFrom":"20","hobbyName":"Skateboard","hobbyParent":"Olahraga"},{"hobbySubFrom":"20","hobbyName":"Tenis","hobbyParent":"Olahraga"},{"hobbySubFrom":"20","hobbyName":"Tenis Meja","hobbyParent":"Olahraga"},{"hobbySubFrom":"20","hobbyName":"Senam","hobbyParent":"Olahraga"},{"hobbySubFrom":"20","hobbyName":"Diving","hobbyParent":"Olahraga"},{"hobbySubFrom":"20","hobbyName":"Hiking","hobbyParent":"Olahraga"},{"hobbySubFrom":"20","hobbyName":"Voli","hobbyParent":"Olahraga"},{"hobbySubFrom":"20","hobbyName":"Yoga","hobbyParent":"Olahraga"},{"hobbySubFrom":"0","hobbyName":"Menjahit","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Kuliner","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Fashion\/Busana","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Desain","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Adventure\/Berpetualang","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Memancing","hobbyParent":null},{"hobbySubFrom":"0","hobbyName":"Dunia Penerbangan","hobbyParent":null}]';
        foreach(json_decode($seeds) as $row) :
            $seed = collect($row);
            $seed->pull('hobbyParent');
            Hobby::create($seed->toArray());
        endforeach;
    }
}
