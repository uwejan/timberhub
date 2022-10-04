<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Products;
use App\Models\Specifications;
use App\Models\Suppliers;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Suppliers::factory(5)->create();


        Products::factory(5)->create();


        Specifications::factory(5)->create();

    }
}
