<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('love')->insert([[
            'name' => '孙晓东',
            'phone' => '15830715551'
        ],[
            'name' => '刘万涛',
            'phone' => '13521760670'
        ]]);
    }
}
