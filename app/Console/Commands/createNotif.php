<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Http\Controllers\Helpers\Main;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Notification;

class createNotif extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create_notif';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to craete notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Notification::create([
                    'user_id' => 1, //tujuan notif
                    'title' => '🔔Example Notif '.Main::generateRandomString(5),
                    'message' => 'Message Notif Example '.Main::generateRandomString(5),
                    'type' => 'primary', //primary, info, success, danger, warning
                    'link' => 'home', // bisa url eksternal
                    'payload' => json_encode([
                        'id' => 1,
                        'title' => '🔔Example Notif 1',
                        'body' => 'Message Notif 1 Example'
                    ])
                ]);
        $this->info('generate 1 notif success');
    }
}
