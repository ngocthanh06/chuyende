<?php

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // factory(App\Models\Employer::class,10)->create();
        factory(App\Models\Company::class,1)->create();
        factory(App\Models\FormM::class,1)->create(); 
        // factory(App\Models\WorkShifts::class,10)->create();
        // factory(App\User::class, 1)->create();
        // factory(App\Models\Role::class, 1)->create();
        factory(App\Models\ContactM::class, 10)->create();
            
        \DB::table('users')->insert(array([
            'password' => bcrypt('123123'), 
            'User_fullname' => 'Admin',
            'username' => 'admin',
            'Role_id' => 2
        ],
        [
            'password' => bcrypt('123123'), 
            'User_fullname' => 'Nhân viên',
            'username' => 'nhanvien',
            'Role_id' => 1
        ]));


        \DB::table('role')->insert(array(
            [
                'Role_name' => 'Nhân viên',
                'Role_desc' => 'user',
                'coefficient' => rand(1, 10),
                'price' => rand(10, 100)
            ],
            [
                'Role_name' => 'Admin',
                'Role_desc' => 'admim',
                'coefficient' => rand(1, 10),
                'price' => rand(10, 100)
            ])
            );
    }
}
