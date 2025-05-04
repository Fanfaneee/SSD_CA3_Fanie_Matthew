<?php
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'mattAdmin',
            'email' => 'mattjpt@gmail.com',
            'password' => bcrypt('12345678'), // Use a secure password
            'is_admin' => 1, // Set as admin
        ]);
    }
}