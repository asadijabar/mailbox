<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seed mail table
        $this->call(mailSeeder::class);
        $this->call(UserSeeder::class);
    }
}
