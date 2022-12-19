<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // \App\Models\User::factory(10)->create();
        if (User::where('email', 'admin@admin.com.br')->count() == 0) {
            User::create([
                'name' => 'Administrador',
                'email' => 'admin@admin.com.br',
                'password' => '123456',
                'active' => true,
                'super_user' => true
            ]);
        }
    }
}
