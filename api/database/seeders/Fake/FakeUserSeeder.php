<?php

namespace Database\Seeders\Fake;

use App\Models\AddressArea;
use App\Models\CustomerAddress;
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
                'email' => 'admin@email.com',
                'email_verified_at' => null,
            ]
        );

        $areas = AddressArea::all();

        for ($i = 0; $i < 10; $i++) {
            $user = \App\Models\User::factory([
                'role_id' => $roles->whereNotIn('slug', ['superadmin', 'admin'])->random(1)->first()->id
            ])->create();

            $randomAreaId = $areas->random(1)->first()->id;

            CustomerAddress::create([
                'address' => $this->faker->address,
                'address_area_id' => $randomAreaId,
                'user_id' => $user->id
            ]);
        }
    }
}
