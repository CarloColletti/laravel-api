<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shoe;
use Faker\Generator as Faker;

class ShoeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
    public function run(Faker $faker)
    {
      for($i = 0; $i < 75; $i++) {
        $shoe = new Shoe;
        $shoe -> name = $faker->firstNameMale();
        $shoe -> brand = $faker->state();
        $shoe -> size = $faker->numberBetween(0, 55);
        $shoe -> price = $faker->randomFloat(2, 10, 200);
        $shoe -> type = $faker->randomElement(['elegant', 'sportive', 'casual']);
        $shoe -> img = "https://picsum.photos/300/200";
        $shoe ->save();
      }
    }
}
