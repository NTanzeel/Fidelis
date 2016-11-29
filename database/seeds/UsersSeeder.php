<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        App\Models\User::create([
            'name'       => 'Naqash Tanzeel',
            'username'   => 'ntanzeel',
            'email'      => 'n.tanzeel@hotmail.co.uk',
            'password'   => bcrypt('123456'),
            'about'      => '4th year Computer Science student at University of Warwick.',
            'dob'        => \Carbon\Carbon::create(1994, 11, 9),
            'reputation' => 0,
            'photo'      => '',
            'cover'      => '',
            'is_private' => False,
        ]);

        App\Models\User::create([
            'name'       => 'Ishe Gambe',
            'username'   => 'igambe',
            'email'      => 'ishegambe@yahoo.co.uk',
            'password'   => bcrypt('rubberducky'),
            'about'      => '4th year Computer Science student at University of Warwick.',
            'dob'        => \Carbon\Carbon::create(1995, 2, 14),
            'reputation' => 0,
            'photo'      => '',
            'cover'      => '',
            'is_private' => False,
        ]);

        App\Models\User::create([
            'name'       => 'Thomas McAloone',
            'username'   => 'tmcaloone',
            'email'      => 'tmac@gmail.com',
            'password'   => bcrypt('password1'),
            'about'      => '4th year Computer Science student at University of Warwick.',
            'dob'        => \Carbon\Carbon::create(1995, 12, 21),
            'reputation' => 0,
            'photo'      => '',
            'cover'      => '',
            'is_private' => False,
        ]);

        App\Models\User::create([
            'name'       => 'Jordan Olney',
            'username'   => 'jolney',
            'email'      => 'jordanolney@gmail.com',
            'password'   => bcrypt('password2'),
            'about'      => '4th year Computer Science student at University of Warwick.',
            'dob'        => \Carbon\Carbon::create(1995, 3, 4),
            'reputation' => 0,
            'photo'      => '',
            'cover'      => '',
            'is_private' => False,
        ]);
    }
}
