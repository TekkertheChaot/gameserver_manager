<?php

use Illuminate\Database\Seeder;

class GroupPrivilegeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\GroupPrivilege::class, 5)->create();
    }
}
