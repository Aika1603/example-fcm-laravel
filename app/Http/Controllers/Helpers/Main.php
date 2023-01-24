<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Agent;
use DateTime;

class Main extends Controller
{
    public static function slack_log($type, $message)
    {
        Log::$type($message, [
            'from' => request()->ip(),
            'url' => url()->current(),
            'request' => (request()->all()) ?? NULL,
            'time' => Carbon::now()->isoFormat('dddd, D MMMM Y HH:mm:ss'),
        ]);
        return true;
    }

    public static function clearData($param = '')
    {
        if (substr($param, -1) == ' ' || substr($param, -1) == ' ') {
           $param = substr($param, 0, -1);
        }
        return  str_replace(" ", "", $param);
    }


    public static function encodeId($value = null)
    {
        return Self::generateRandomString(20) . bin2hex($value);
    }

    public static function decodeId($value = null)
    {
        try{
            return hex2bin(substr($value, 20));
        }catch(\Throwable $th) {
            return false;
        }
    }

    public static function currency_idr($angka)
    {

        if ($angka == null or $angka == '') :
            $hasil_rupiah = "Rp. 0";
        else :
            $hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.');
        endif;

        return $hasil_rupiah;
    }

    public static function sensorHandphone($phone)
    {
        $jumlah_sensor = 4;
        $setelah_angka_ke = 4;

        $censored = mb_substr($phone, $setelah_angka_ke, $jumlah_sensor);

        $phone2 = explode($censored, $phone);

        $phone_new = $phone2[0] . "****" . $phone2[1];

        return $phone_new;
    }

    public static function getEndofWeek()
    {
        return Carbon::now('Asia/Jakarta')->addDays(7)->format('Y-m-d');
    }

    public static function getUserAgent(): array
    {
        return [
            'browser' => Agent::browser(),
            'version' => Agent::version(Agent::browser()),
            'platform' => Agent::platform(),
            'mobiles' => Agent::device()
        ];
    }

    public static function generateRandomString($length = 10, $type = 'normal')
    {
        if ($type === 'normal') {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        } elseif($type === 'alphabet') {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        } elseif($type === 'numeric') {
            $characters = '0123456789';
        } else {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    public static function getClientIp($request): string
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = $request;
        return $ipaddress;
    }

    public function limit_desc($string = null,  $limit = 50)
    {
        $string = strip_tags($string);
        if (strlen($string) > $limit) {

            $stringCut = substr($string, 0, $limit);
            $endPoint = strrpos($stringCut, ' ');

            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $string .= '...';
        }
        return $string;
    }

}
