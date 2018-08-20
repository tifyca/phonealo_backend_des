<?php

use Illuminate\Database\Seeder;
use App\User; 

class users_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   

    public function run()
    {
 
     DB::table('users')->insert([
        'name' => 'Administrador',
        'email' => 'yoe318@gmail.com',
        'password' => bcrypt('123456'),
        ]); 
    }
     DB::table('users')->insert([
        'name' => 'Anthoni Rodriguez',
        'email' => 'yosec.cervino@gmail.com',
        'password' => bcrypt('123456'),
        ]); 
    }

     DB::table('users')->insert([
        'name' => 'Ana Bravo',
        'email' => 'anabravo@an.gob.ve',
        'password' => bcrypt('123456'),
        ]); 
    }

}
