<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminUser::create([
          'name' => 'Admin',
          'email' => 'falkin95@mail.ru',
          'password' => bcrypt('Falkin5721Falkin5721')
        ]);
    }
}
