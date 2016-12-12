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
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'city' => str_random(10),
            'country' => str_random(10),
            'password' => bcrypt('secret'),
        ]);

        DB::table('users')->insert(array(
            array('name' => 'John', 'email' => 'john@gmail.com', 'city' => 'New york', 'country' => 'USA',
                'password' => bcrypt('secret'),),
            array('name' => 'Kennedy', 'email' => 'keneddy@gmail.com', 'city' => 'Washington', 'country' => 'USA',
                'password' => bcrypt('secret'),),
            array('name' => 'Obama', 'email' => 'obama@gmail.com', 'city' => 'Washington', 'country' => 'USA',
                'password' => bcrypt('obama'),),
            array('name' => 'Trump', 'email' => 'trump@gmail.com', 'city' => 'LA', 'country' => 'USA',
                'password' => bcrypt('secret'),),
        ));
    }
}
