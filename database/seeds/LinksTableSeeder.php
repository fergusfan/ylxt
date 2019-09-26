<?php

use Illuminate\Database\Seeder;

use App\Link;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Link::class, 10)->create();
    }
}
