<?php

namespace Database\Factories;

use App\Models\Phone;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\UserOrm;
use Faker\Generator as Faker;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserOrmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $array = array ('Trịnh','Nguyễn','Lê','Hoàng','Trần','Hà','Tống','Ngô');
        return [
            'name' => $this->faker->name(),
            'first_name' => $array[rand(0,count($array)-1)],
            'last_name' => $this->faker->name(),
            'class' => 'class' . rand(1,10),
        ];
    }

    public function configure()
    {
       
        return $this->afterCreating(function (UserOrm $user,$roles) {
            Phone::factory(1)->create([
                'user_id' => $user->id,
                'number' => $this->faker->unique()->numerify('##########')
                ]);
            RoleUser::factory(1)->create(
                [
                    'user_id' => $user->id,
                ]

            );
        });
    }

}
