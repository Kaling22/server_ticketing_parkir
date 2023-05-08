<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\data_kendaraan_parkir;

class DataKendaraanParkirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $faker = Faker::create('id_ID');
    	for($i = 1; $i <= 20; $i++){
    		data_kendaraan_parkir::insert([
    			'id_mahasiswa' => $faker->numberBetween($min = 1000, $max = 9000),
                'nim' =>$faker->numberBetween($min = 1918000, $max = 1918200),
    			'nomer_kendaraan' => $faker->numerify('N #### KTM'),
    			'kendaraan_masuk' => $faker->date($format = 'Y-m-d', $max = 'now'),
    			'kendaraan_keluar' => $faker->date($format = 'Y-m-d', $max = 'now'),
    			'created_at' => $faker->date($format = 'Y-m-d', $min = 'now', $max = 'now'),
    			'updated_at' => $faker->date($format = 'Y-m-d', $min = 'now', $max = 'now'),
    		]);
    	}
    }
}
