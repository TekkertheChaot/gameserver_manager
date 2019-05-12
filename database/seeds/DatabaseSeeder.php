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
         $this->call(AdminUserTableSeeder::class);
         $this->call(LinksTableSeeder::class);
         $this->call(AdminGroupTableSeeder::class);
         $this->call(UserGroupTableSeeder::class);
         $this->call(GameTableSeeder::class);
         $this->call(LGSMHostTableSeeder::class);
         // $this->call(UserPrivilegeTableSeeder::class);
         // $this->call(GroupPrivilegeTableSeeder::class);
         $this->call(ServerCredentialsTableSeeder::class);
         $this->call(ServerTableSeeder::class);
        
    }
}
