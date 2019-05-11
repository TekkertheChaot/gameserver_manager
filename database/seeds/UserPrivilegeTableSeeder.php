<?php

use Illuminate\Database\Seeder;

class UserPrivilegeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\UserPrivilege::class, 5)->create();
    }
}
