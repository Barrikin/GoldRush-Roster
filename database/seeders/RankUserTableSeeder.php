<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RankUserTableSeeder extends Seeder
{
    public function run()
    {
        User::findOrFail(1)->rank(1);
    }
}
