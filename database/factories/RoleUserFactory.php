<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $roles = [];
        foreach (Role::all() as $role){
            array_push($roles, $role->id);
        }
        return [
            'role_id' => $this->faker->randomElement($array = $roles),
        ];
    }
}
