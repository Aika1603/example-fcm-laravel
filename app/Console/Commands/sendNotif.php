<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Notification;

class sendNotif extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send_notif';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command send notif to fcm';

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
        $this->handleFcm(10);
        $this->info('success send notif');
    }

    public function handleFcm($limit = 10)
    {
        try {
            $url = 'https://fcm.googleapis.com/fcm/send';
            $headers = array(
                'Authorization:key = '.env('FCM_SERVER_KEY', ''),
                'Content-Type: application/json'
                );

            $get_data = Notification::where('is_send', 0)->orderBy('is_urgent', 'DESC')->orderBy('created_at', 'ASC')->limit($limit)->get();
            if(@count($get_data) > 0){
                $res = array();
                $i = 0;
                foreach ($get_data as $row) {
                    $fields = array(
                        'notification' => [
                            'request_type' => $row->type,
                            'request_time' => date('Y-m-d H:i:s'),
                            'sound' => 'default',
                            'title' => @strip_tags($row->title),
                            'body' => @strip_tags($row->message),
                        ],
                    );
                    $encode_payload = json_decode($row->payload);
                    $fields['data'] = [
									    'url' => url('notification/view/'.$row->id),
                                        'payload' => json_decode($row->payload)
                                    ];

                    //get token fcm
                    $user = User::select('fcm')->where('id', $row->user_id)->first();
                    $fields['registration_ids'] = [$user->fcm];

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                    $result = curl_exec($ch);
                    curl_close($ch);
                    $res = json_decode($result);

                    //update
                    Notification::where('id', $row->id)->update([
                        'is_send' => '1',
                    ]);
                    $i++;
                }
            }
            return true;

        } catch (\Throwable $error) {
            $this->error($error);
            return true;
        }
    }
}
