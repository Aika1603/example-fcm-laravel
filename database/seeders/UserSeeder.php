<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Notification;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Superadmin',
            'username' => 'superadmin',
            'email' => 'superadmin@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'),
        ]);

        // notification
        Notification::create([
                    'user_id' => $user->id,
                    'title' => '🔔Example Notif 1',
                    'message' => 'Message Notif 1 Example',
                    'type' => 'primary', //primary, info, success, danger, warning
                    'link' => 'home', // bisa url eksternal
                    'payload' => json_encode([
                        'id' => 1,
                        'title' => '🔔Example Notif 1',
                        'body' => 'Message Notif 1 Example'
                    ])
                ]);
    }
}
