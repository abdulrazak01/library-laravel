<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class TableBukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = \Faker\Factory::create();
        \DB::table('buku')->truncate();

        for ($i=0; $i < 100; $i++)
        {
            DB::table('buku')->insert(
                [
                    'judul' => $faker->sentence(3),
                    'penerbit' => $faker->name,
                    'stock' => $faker->numberBetween(1,10),
                    'tanggal_terbit' => $faker->date,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
                );
        }
    }
}
