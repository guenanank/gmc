<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::statement("SET foreign_key_checks=0");
        DB::table('users')->truncate();
        DB::statement("SET foreign_key_checks=1");
        $seeds = '[{"username":"000000","email":"root@gramedia-majalah.com","password":"$2y$10$DiSo.24NBcXLdPBULRKo1OSsNZSsBS6k60.O4J7pAsrAdvl.msLqm"},{"username":"007165","email":"asti@gramedia-majalah.com","password":"$2y$10$Otmfa9M8MXrG4sWqoD717u8ua9CCMRMyB0YrzPhleUFNNdHWhdnEK"},{"username":"003293","email":"teddy@gramedia-majalah.com","password":"$2y$10$Otmfa9M8MXrG4sWqoD717u8ua9CCMRMyB0YrzPhleUFNNdHWhdnEK"},{"username":"001780","email":"yana@gramedia-majalah.com","password":"$2y$10$Otmfa9M8MXrG4sWqoD717u8ua9CCMRMyB0YrzPhleUFNNdHWhdnEK"},{"username":"037462","email":"dewi_w@gramedia-majalah.com","password":"$2y$10$Otmfa9M8MXrG4sWqoD717u8ua9CCMRMyB0YrzPhleUFNNdHWhdnEK"},{"username":"013046","email":"annisa@gramedia-majalah.com","password":"$2y$10$Otmfa9M8MXrG4sWqoD717u8ua9CCMRMyB0YrzPhleUFNNdHWhdnEK"},{"username":"006426","email":"yuniah@gramedia-majalah.com","password":"$2y$10$Otmfa9M8MXrG4sWqoD717u8ua9CCMRMyB0YrzPhleUFNNdHWhdnEK"},{"username":"004502","email":"evitani@gramedia-majalah.com","password":"$2y$10$Otmfa9M8MXrG4sWqoD717u8ua9CCMRMyB0YrzPhleUFNNdHWhdnEK"},{"username":"001795","email":"lianih@gramedia-majalah.com","password":"$2y$10$Otmfa9M8MXrG4sWqoD717u8ua9CCMRMyB0YrzPhleUFNNdHWhdnEK"}]';
        DB::table('users')->insert(json_decode($seeds));
        
//        foreach (json_decode($seeds) as $row) :
//            $seed = collect($row)->toArray();
//            Source::create($seed);
//        endforeach;
    }

}
