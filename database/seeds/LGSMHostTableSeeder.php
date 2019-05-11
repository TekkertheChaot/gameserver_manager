<?php

use Illuminate\Database\Seeder;

class LGSMHostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\LGSMHost::class, 2)->create();
    }
}
