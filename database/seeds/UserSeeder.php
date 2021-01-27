<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::where('email', 'ahuja.devansh2@gmail.com')->get()->first();
        if(!$user) {
            \App\User::create([
                'name' => 'Devansh Ahuja',
                'email' => 'ahuja.devansh2@gmail.com',
                'password' => \Illuminate\support\Facades\Hash::make('qwertyuiop'),
                'role' => 'admin',
            ]);
        }
        else {
            $user->update(['role'=>'admin']);
        }

        \App\User::create([
            'name' => 'rahul',
            'email' => 'rahul@gmail.com',
            'password' => \Illuminate\support\Facades\Hash::make('qwertyuiop'),
        ]);

        \App\User::create([
            'name' => 'Sahil',
            'email' => 'sahil@gmail.com',
            'password' => \Illuminate\support\Facades\Hash::make('qwertyuiop'),
        ]);

        \App\User::create([
            'name' => 'sonu',
            'email' => 'sonu@gmail.com',
            'password' => \Illuminate\support\Facades\Hash::make('qwertyuiop'),
        ]);
    }
}
