<?php

use Illuminate\Database\Seeder;

class ServerCredentialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ServerCredentials::class, 5)->create();
    }
}
