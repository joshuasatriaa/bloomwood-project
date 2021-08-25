<?php

namespace Database\Seeders\Fake;

use App\Models\AddressArea;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FakeUserSeeder extends Seeder
{
    protected $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker->create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();

        \App\Models\User::factory(1)->create(
            [
                'name' => 'Superadmin',
                'role_id' => $roles->where('slug', 'superadmin')->first()->id,
                'email' => config('app.superadmin_mail'),
                'email_verified_at' => null,
            ]
        );

        \App\Models\User::factory(1)->create(
            [
                'name' => 'Admin',
                'role_id' => $roles->where('slug', 'admin')->first()->id,
                'email_verified_at' => null,
            ]
        );

        $areas = AddressArea::all();

        for ($i = 0; $i < 10; $i++) {
            $user = \App\Models\User::factory([
                'role_id' => $roles->whereNotIn('slug', ['superadmin', 'admin'])->random(1)->first()->id
            ])->create();

            for ($x = 0; $x < random_int(1, 2); $x++) {
                $randomAreaId = $areas->random(1)->first()->id;

                $user->customerAddresses()->create([
                    'address' => $this->faker->address,
                    'address_area_id' => $randomAreaId
                ]);
            }
        }
    }
}
