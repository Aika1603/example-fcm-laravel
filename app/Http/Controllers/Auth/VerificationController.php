<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\UserVerify;
use App\Http\Controllers\Helpers\Main;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class VerificationController extends Controller
{
    private $data = [];

    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Default throttle for resend mail
     * 
     * @var string
     * 
     */
    protected $throttle = '15'; //minutes

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data = [
                        'title'             => 'Verify Your Email Address',
                        'subtitle'          => '',
                        'menu'              => 'Verify Your Email Address',
                        'link_menu'         => '',
                        'icon_menu'         => 'icon-info22',
                        'submenu'           => '',
                        'link_submenu'      => '',
                        'icon_submenu'      => '',
                        'subsubmenu'        => '',
                        'icon_subsubmenu'   => '',
                        'route'             => 'verify',
                        'permission'        => 'verify',
                        'icon-primary'      => '',
                        'no'                => 1
                      ];
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                        ? redirect($this->redirectPath())
                        : view('auth.verify', $this->data);
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    private function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'status' => true,
                '_token' => csrf_token(),
                'message' => 'Akun Anda sudah terverifikasi',
                'return_url' => route('dashboard')
            ]);
        }

        /**
         * throttle check
         */
        $check = UserVerify::where('user_id', $request->user()->id)->orderBy('id', 'DESC');
        if($check->count() > 0){
            $get  = $check->first();
            $date = Carbon::parse($get->created_at);
            $now  = Carbon::now(config('app.timezone'));
            $diff = $date->diffInMinutes($now);
            if($diff < $this->throttle){
                $wait = $this->throttle - $diff;
                return response()->json([
                    'status' => false,
                    '_token' => csrf_token(),
                    'message' => "Tunggu sekitar $wait menit untuk melakukan permintaan ulang",
                    'return_url' => '#'
                ]);
                return response()->json($res);
            }
        }

        $token = Str::random(64);

        UserVerify::create([
            'user_id' => $request->user()->id,
            'token' => $token
        ]);

        $message = Main::mail_text_verify([
            'img_url' => config('app.img_url'),
            'app_name' =>  'Panel Administrator '.config('app.name'),
            'name' => $request->user()->name,
            'link' => url("/verify-auth/$token")
        ]);

        $api_res  = json_decode(Http::withBasicAuth(config('app.username_mail_auth_basic'), config('app.password_mail_auth_basic'))->post(config('app.url_mail_auth_basic'),[
            'from_name' => config('app.name'),
            'to' => $request->user()->email,
            'subject'  => 'Verifikasi Akun Baru',
            'html' => $message,
        ]));

        /**
         * Error handling
         */
        if(@$api_res->status == false){
            //delete token verify
            DB::table('users_verify')->where('user_id', $request->user()->id)->delete();

            return response()->json([
                'status' => false,
                '_token' => csrf_token(),
                'message' => 'Gagal mengirim surel verifikasi alamat email',
                'return_url' => '#'
            ]);
        }

        return response()->json([
            'status' => true,
            '_token' => csrf_token(),
            'message' => 'Surel verifikasi alamat email berhasil dikirim ulang.',
            'return_url' => '#'
        ]);
    }
}
