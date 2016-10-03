<?php

use Illuminate\Database\Seeder;
use App\Expense;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        Expense::truncate();
        DB::statement("SET foreign_key_checks=1");
        $seeds = '[{"expenseMin":"0.00","expenseMax":"900000.00"},{"expenseMin":"900001.00","expenseMax":"1250000.00"},{"expenseMin":"1250001.00","expenseMax":"1750000.00"},{"expenseMin":"1750001.00","expenseMax":"2500000.00"},{"expenseMin":"2500001.00","expenseMax":"4000000.00"},{"expenseMin":"4000001.00","expenseMax":"6000000.00"},{"expenseMin":"6000001.00","expenseMax":"10000000.00"},{"expenseMin":"10000001.00","expenseMax":"15000000.00"},{"expenseMin":"15000000.00","expenseMax":"0.00"}]';
        foreach(json_decode($seeds) as $row) :
            $seed = collect($row)->toArray();
            Expense::create($seed);
        endforeach;
    }
}
