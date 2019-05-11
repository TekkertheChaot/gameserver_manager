<?php

use Illuminate\Database\Seeder;

class ServerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Server::class, 5)->create();
    }
}
