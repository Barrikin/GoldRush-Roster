<?php

namespace Database\Seeders;

use App\Models\Rank;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RankTableSeeder extends Seeder
{
    public function run()
    {
        $ranks = [
            ['title' => 'Chief'],
            ['title' => 'Deputy Chief'],
            ['title' => 'Captain'],
            ['title' => 'Lieutenant'],
            ['title' => 'Sergeant'],
            ['title' => 'Corporal'],
            ['title' => 'Senior Officer'],
            ['title' => 'Officer'],
            ['title' => 'Probationary Officer'],
            ['title' => 'Cadet'],
        ];

        Rank::insert($ranks);
    }
}
