<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class TaPulsaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 100; $i++){
 
    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('ta_pulsa')->insert([
    			'kategori' => $faker->word,
    			'operator' => $faker->word,
    			'nominal' => $faker->randomNumber,
    			'no_hp' => $faker->phoneNumber,
    			'harga' => $faker->randomNumber,
    			'user_id' => $faker->numberBetween(10,12),
    		]);
 
    	}
    }
}
