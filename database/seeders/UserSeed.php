<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder{
   
    public function run(): void{
        //add user
        $user = new User();
        $user->name = 'AppConsumer001';
        $user->email = 'appconsumer01@api.com';
        $user->password = bcrypt('123456');
        $user->save();
    }
}
