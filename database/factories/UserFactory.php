<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Admin;
use App\Models\Dosen;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    use HasFactory;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $factory->define(User::class, function (Faker $faker) {
            return [
                'username' => $faker->unique()->userName,
                'password' => bcrypt('password'),
                'role' => $faker->randomElement(['admin', 'dosen']),
                'admin_id' => function () {
                    return factory(Admin::class)->create()->id;
                },
                'dosen_id' => function () {
                    return factory(Dosen::class)->create()->id;
                },
            ];
        });
    }
}
