<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $websites = [
            [ 'url' => 'test1.am'],
            [ 'url' => 'test2.com'],
            [ 'url' => 'test3.com'],
            [ 'url' => 'test4.ru'],
            [ 'url' => 'test5.org'],
            [ 'url' => 'test6.am'],
            [ 'url' => 'test7.am'],
            [ 'url' => 'test8.am'],
            [ 'url' => 'test9.ru'],
            [ 'url' => 'test10.am'],
        ];

        foreach ($websites as $website) {
            Website::create($website);
        }
    }
}
