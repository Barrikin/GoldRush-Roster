<?php

namespace Database\Seeders;

use App\Models\Certification;
use Illuminate\Database\Seeder;

class CertificationsTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'FTO'],
            ['name' => 'Head FTO'],
            ['name' => 'Class 1'],
            ['name' => 'Class 2'],
            ['name' => 'Class 3'],
            ['name' => 'Traffic'],
            ['name' => 'Air'],
            ['name' => 'SWAT'],
            ['name' => 'Detective'],
        ];

        Certification::insert($roles);
    }
}
