<?php

use App\Models\Vote;
use Illuminate\Database\Seeder;

class VotesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Vote::create([
            'user_id'    => 1,
            'comment_id' => 3,
            'type'       => 1,
        ]);
        Vote::create([
            'user_id'    => 2,
            'comment_id' => 3,
            'type'       => -1,
        ]);
        Vote::create([
            'user_id'    => 2,
            'comment_id' => 4,
            'type'       => 1,
        ]);
        Vote::create([
            'user_id'    => 4,
            'comment_id' => 1,
            'type'       => 1,
        ]);
        Vote::create([
            'user_id'    => 3,
            'comment_id' => 2,
            'type'       => -1,
        ]);
    }
}