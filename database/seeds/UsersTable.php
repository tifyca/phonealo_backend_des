<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 
	    User::create([
	        'name' => 'Administrador',
	        'email' => 'yoe318@gmail.com',
	        'password' => bcrypt('123456')
	    ]);

	    User::create([
	        'name' => 'Anthoni',
	        'email' => 'yosec.cervino@gmail.com',
	        'password' => bcrypt('123456')
	    ]);

	    User::create([
	        'name' => 'Ana',
	        'email' => 'anitac.bravo@gmail.com',
	        'password' => bcrypt('123456')
	    ]);

}

}
