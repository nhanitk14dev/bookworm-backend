<?php

namespace Database\Seeders;

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
        // Use class Factory
        // \App\Models\User::factory(3)->create();
        \App\Models\Author::factory(3)->create();
        \App\Models\Category::factory(3)->create();

        // Run all to import data default
        $this->call([
            BookSeeder::class,
            BookV2Seeder::class,
            ReviewSeeder::class,
            ReviewSeederV2::class,
            DiscountsSeeder::class,
            UpdateValuesColunmsExtraBooks::class,
        ]);
    }
}
