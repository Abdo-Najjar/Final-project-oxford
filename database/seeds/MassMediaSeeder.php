<?php

use App\MassMedia;
use Illuminate\Database\Seeder;

class MassMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(MassMedia::class ,100)->create();
        factory(MassMedia::class ,100)->states('viedo')->create();

    }
}
