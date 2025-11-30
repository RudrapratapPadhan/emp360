<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(User::where('email', 'admin@ems.com')->exists()) {
             $this->command->info('Admin user already exists. Skipping creation.');
              return;

        }   

            
       // Create initial admin user
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@ems.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@ems.com');
        $this->command->info('Password: admin123');
    }
}
