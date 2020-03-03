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
        factory(App\Models\Employer::class,10)->create();
        factory(App\Models\Company::class,10)->create();
        factory(App\Models\FormM::class,2)->create(); 
        // factory(App\Models\WorkShifts::class,10)->create();

    }
}
