<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        App\Models\User::create([
            'name'      => 'Naqash Tanzeel',
            'email'     => 'n.tanzeel@hotmail.co.uk',
            'password'  => bcrypt('123456'),
            'dob'       => \Carbon\Carbon::create(1994, 11, 9),
        ]);

        App\Models\User::create([
            'name'      => 'Ishe Gambe',
            'email'     => 'ishegambe@yahoo.co.uk',
            'password'  => bcrypt('rubberducky'),
            'dob'       => \Carbon\Carbon::create(1995, 2, 14),
        ]);
    }
}
