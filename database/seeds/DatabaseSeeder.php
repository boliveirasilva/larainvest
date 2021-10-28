<?php

use App\Entities\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'cpf' => '12345678909',
            'name' => 'Betha Tester da Silva',
            'phone' => '11999998888',
            'birth' => '1940-07-04',
            'gender' => 'M',
            'email' => 'betha.tester@teste.net.br',
            'password' => env('PASSWORD_HASH') ? bcrypt('123456') : '123456',
        ]);

        // $this->call(UsersTableSeeder::class);
    }
}
