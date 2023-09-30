<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_user')->insert([
            'name' => 'Роман',
            'email' => 'falkin95@mail.ru',
            'password' => Hash::make('123456'), // Замените 'пароль' на актуальный пароль
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
