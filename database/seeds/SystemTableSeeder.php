<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('systems')->insert([[
            'title' => '云课程'
        ],[
            'title' => '财务系统'
        ]]);
    }
}
