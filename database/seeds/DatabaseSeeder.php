<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $roles = [
            'Administrator', 'Employee'
        ];

        for($i = 1; $i <= 3; $i++) {
            DB::table('cities')->insert([
                'name' => $faker->city,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::table('companies')->insert([
                'city_id' => $i,
                'name' => $faker->company,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::table('departments')->insert([
                'company_id' => $i,
                'name' => $faker->catchPhrase,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        DB::table('users')->insert([
            'name' => 'Ad',
            'last_name' => 'Min',
            'password' => bcrypt('12341234'),
            'email' => 'admin@example.com',
            'role_id' => 1,
            'company_id' => 0,
            'department_id' => 0,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'name' => $role,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
