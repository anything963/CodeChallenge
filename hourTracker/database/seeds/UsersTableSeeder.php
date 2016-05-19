<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        User::create([
            'name'=>'Ashley',
            'email'=>'ashley@reach.com',
            'password'=>Hash::make('1234')
        ]);
        User::create([
            'name'=>'Dave',
            'email'=>'dave@reach.com',
            'password'=>Hash::make('password')
        ]);
        User::create([
            'name'=>'Jim',
            'email'=>'jim@reach.com',
            'password'=>Hash::make('12345')
        ]);
        User::create([
            'name'=>'Ralph',
            'email'=>'ralph@reach.com',
            'password'=>Hash::make('12345678')
        ]);
        User::create([
            'name'=>'Jessica',
            'email'=>'jessica@reach.com',
            'password'=>Hash::make('test')
        ]);
        User::create([
            'name'=>'Mary',
            'email'=>'mary@reach.com',
            'password'=>Hash::make('admin')
        ]);
    }
}
