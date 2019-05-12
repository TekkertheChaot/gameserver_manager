<?php

use Illuminate\Database\Seeder;

class AdminGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AdminGroup::class, 1)->create();
    }
}
