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
         $this->call(LinksTableSeeder::class);
         $this->call(GameTableSeeder::class);
         $this->call(GroupTableSeeder::class);
         $this->call(LGSMHostTableSeeder::class);
         $this->call(PrivilegeTableSeeder::class);
         $this->call(ServerCredentialsTableSeeder::class);
         $this->call(ServerTableSeeder::class);
    }
}
