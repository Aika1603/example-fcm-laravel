<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Notification;

class NotificationController extends Controller
{
    private $data = [];

    public function index(Request $request)
    {
        $this->data['datatable'] = Notification::where(['user_id' => Auth::user()->id])
                                                ->orWhere(['is_topic' => '1'])
                                                ->orderBy('id', 'DESC')
                                                ->limit(500)
                                                ->get();
        return view('notification.index', $this->data);
    }

    public function get(Request $request, $last_id = 0)
    {
        $last_id = (integer) $last_id;
        $content = Notification::where(['user_id' => Auth::user()->id])->orWhere(['is_topic' => '1'])->limit(5)->orderBy('id', 'DESC')->get();
        $data_notifikasi = [
            "status" => true,
            "content" =>  $content,
            "all" =>  Notification::where(['user_id' => Auth::user()->id])->orWhere(['is_topic' => '1'])->count(),
            "new" => $last_id > 0 ? Notification::Where(function($query){
                                $query->where(['user_id' => Auth::user()->id]);
                                $query->orWhere(['is_topic' => '1']);
                            })->where('id', '>', $last_id)->count() : 0, 
            "unseen" => Notification::Where(function($query){
                                $query->where(['user_id' => Auth::user()->id]);
                                $query->orWhere(['is_topic' => '1']);
                            })->where(['is_seen' => '0'])->count(),
        ];

        //get last notif id
        foreach ($content as $row) {
            $last_id = $last_id < $row->id ? $row->id : $last_id;
        }
        $data_notifikasi['last_id'] = $last_id;
        return response()->json($data_notifikasi);
    }

    public function read_all(Request $request)
    {
        Notification::Where(function($query){
                                $query->where(['user_id' => Auth::user()->id]);
                                $query->orWhere(['is_topic' => '1']);
                            })->update(['is_seen' => '1']);
        return response()->json(['status' => true, 'message' => 'All notifications have been marked as read ']);
    }

    public function delete_all(Request $request)
    {
        Notification::Where(function($query){
                                $query->where(['user_id' => Auth::user()->id]);
                                $query->orWhere(['is_topic' => '1']);
                            })->delete();
        return response()->json([
            'status' => true,
            'message' => 'All notifications has been removed',
            'return_url' => url('notification')
        ]);
    }

    public function view(Request $request, $id)
    {
        $notif = Notification::where(['id' => $id])->first();
        if (isset($notif->id)) {
            Notification::where(['id' => $id])->update(['is_seen' => '1']);
            if (@$notif->link != "") {
                return redirect(url($notif->link));
            } else {
                return redirect(url('/dashboard'));
            }
        } else {
            return redirect('/notfound');
        }
    }

    public function update_fcm(Request $request)
    {
        $data           = User::where('id', Auth::user()->id )->first();
        $data->fcm      = $request->input('fcm');
        $query          = $data->save();

        if($query){
            // register user roles as  fcm topic
            // bisa kirim notif berdasarkan topic
            // $userRole  = $data->roles->pluck('name','name')->all();
            // foreach ($userRole as $key => $value) {
            //     $response = Http::withHeaders([
            //         'Authorization' => 'key='.env('FCM_SERVER_KEY'),
            //     ])->post('https://iid.googleapis.com/iid/v1/'.$request->input('fcm').'/rel/topics/'.$value); 
            // }
            
            return response()->json([
                    'status' => true,
                    '_token' => csrf_token(),
                    'message' => 'push fcm success!',
                    'return_url' => '#',
                ]);
        }else{
            return response()->json([
                    'status' => false,
                    '_token' => csrf_token(),
                    'message' => 'fail!',
                    'return_url' => '#'
                ]);
        }
    }


}
