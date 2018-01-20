<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
        	[
        		'link_name' => '百度',
        		'link_title' => '百度一下，你就知道',
        		'link_url' => 'https://www.baidu.com',
        		'link_sort' => 1
        	],
        	[
        		'link_name' => 'Google',
        		'link_title' => 'Google',
        		'link_url' => 'https://www.google.com.hk',
        		'link_sort' => 2
        	]
        ];
        DB::table('links')->insert($data);
    }
}
