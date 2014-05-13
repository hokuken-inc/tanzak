<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->truncate();
        
        $user = new User();
        $user->name = 'guest';
        $user->email = 'guest@sample.com';
        $user->password = Hash::make('guest');
        $user->save();
    }
}
