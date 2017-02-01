<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(EducationSeeder::class);
        //$this->call(ExpenseSeeder::class);
        //$this->call(HobbySeeder::class);
        //$this->call(InterestSeeder::class);
        $this->call(MasterSeeder::class);
        //$this->call(ProfessionSeeder::class);
        //$this->call(SourceSeeder::class);
        //$this->call(LayerSeeder::class);
        //$this->call(QuestionSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
