<?php

use Illuminate\Database\Seeder;

class UserdocsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Userdoc::class, 5)->create();
    }
}
