<?php

use Illuminate\Database\Seeder;

class FollowresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Followres::class,100)->create();
    }
}
