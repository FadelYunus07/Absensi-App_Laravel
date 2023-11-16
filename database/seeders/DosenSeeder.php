<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\Dosen;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factory;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Models\Dosen::class,5)->create();
    }
}
