<?php

use Illuminate\Database\Seeder;

class UserExtraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::all();
        foreach($users as $user){
            \App\Models\UserExtra::create([
                'id' => \Webpatser\Uuid\Uuid::generate(),
                'user_id' => $user->id,
            ]);
        }
    }
}
