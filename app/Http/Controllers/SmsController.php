<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SmsController extends Controller
{
    public function SendSms(Request $req)
    {
        $req->validate([
            'full_name'=>'required',
            'password'=>'required',
            'phone'=>'required'
        ]);
        session()->put("full_name", $req->full_name);
        session()->put("password", $req->password);
        session()->put("phone", $req->phone);
        $number = preg_replace('/\D/', '', $req->phone);
        if (strlen($number) == 9) {
            $number = "998".$number;
        }

        $code = rand(10000,99999);
        session()->put("code", $code);
        $token = DB::table('sms')
            ->where('id',1)
            ->first();
        $current_date = Carbon::now();
        $token_expiry_date = Carbon::parse($token->created_at)->addMonth();
        if($current_date->greaterThan($token_expiry_date))
        {
            // Renew the token
            $client = new Client();
            $options = [
            'multipart' => [
                [
                'name' => 'email',
                'contents' => 'your_email'
                ],
                [
                'name' => 'password',
                'contents' => 'your_password'
                ]
            ]];
            $request = new \GuzzleHttp\Psr7\Request('POST', 'notify.eskiz.uz/api/auth/login');
            $res = $client->sendAsync($request, $options)->wait();
            $respon =  $res->getBody()->getContents();
            // $dt = $respon['data'];
            $dt = json_decode($respon, true);
            // dd($dt);
            DB::table('sms')
                ->where('id',1)
                ->update([
                    'token' => $dt['data']['token'],
                    'created_at' => Carbon::now()
                ]);
        }

        // Send SMS using the updated token
        $token = $token->token;
        
        $user = new Client();
        $headers = [
            'Authorization' => "Bearer {$token}"
        ];
        $options1 = [
            'multipart' => [
              [
                'name' => 'mobile_phone',
                'contents' => "{$number}"
              ],
              [
                'name' => 'message',
                'contents' => "ytest.uz saytidagi tasdiqlash kodingiz: {$code}"
              ],
              [
                'name' => 'from',
                'contents' => '4546'
              ],
              [
                'name' => 'callback_url',
                'contents' => 'http://0000.uz/test.php'
              ]
          ]];
        $request = new \GuzzleHttp\Psr7\Request('POST', 'notify.eskiz.uz/api/message/sms/send', $headers);
        $res = $user->sendAsync($request,$options1)->wait();
        return view('user.sms_conf',['code'=>$code]);
    }

    public function reset($phone, $user_id)
    {
        $reset_user = DB::table('reset_password')
            ->where('user_id', $user_id)
            ->first();
        if (empty($reset_user)) {
            return abort(404); 
        }
        $number = preg_replace('/\D/', '', $phone);
        if (strlen($number) == 9) {
            $number = "998".$number;
        }
        $token = DB::table('sms')
            ->where('id',1)
            ->first();
        $current_date = Carbon::now();
        $token_expiry_date = Carbon::parse($token->created_at)->addMonth();
        if($current_date->greaterThan($token_expiry_date))
        {
            // Renew the token
            $client = new Client();
            $options = [
            'multipart' => [
                [
                'name' => 'email',
                'contents' => 'your_email'
                ],
                [
                'name' => 'password',
                'contents' => 'your_password'
                ]
            ]];
            $request = new \GuzzleHttp\Psr7\Request('POST', 'notify.eskiz.uz/api/auth/login');
            $res = $client->sendAsync($request, $options)->wait();
            $respon =  $res->getBody()->getContents();
            // $dt = $respon['data'];
            $dt = json_decode($respon, true);
            // dd($dt);
            DB::table('sms')
                ->where('id',1)
                ->update([
                    'token' => $dt['data']['token'],
                    'created_at' => Carbon::now()
                ]);
        }

        // Send SMS using the updated token
        $token = $token->token;
        
        $user = new Client();
        $headers = [
            'Authorization' => "Bearer {$token}"
        ];
        $route = route('reset_conf', ['hash' => $reset_user->hash_phone]);
        $options1 = [
            'multipart' => [
              [
                'name' => 'mobile_phone',
                'contents' => "{$number}"
              ],
              [
                'name' => 'message',
                'contents' => "ytest.uz saytida parolni tiklash uchun link: {$route}"
              ],
              [
                'name' => 'from',
                'contents' => '4546'
              ],
              [
                'name' => 'callback_url',
                'contents' => 'http://0000.uz/test.php'
              ]
          ]];
        $request = new \GuzzleHttp\Psr7\Request('POST', 'notify.eskiz.uz/api/message/sms/send', $headers);
        $res = $user->sendAsync($request,$options1)->wait();
        return view('user.reset_success');
    }
    // public function SendSms(Request $req)
    // {
    //     $req->validate([
    //         'full_name'=>'required',
    //         'password'=>'required',
    //         'phone'=>'required'
    //     ]);
    //     session()->put("full_name", $req->full_name);
    //     session()->put("password", $req->password);
    //     session()->put("phone", $req->phone);
    //     $number = preg_replace('/\D/', '', $req->phone);
    //     if (strlen($number) == 9) {
    //         $number = "998".$number;
    //     }

    //     $code = rand(10000,99999);
    //     session()->put("code", $code);
    //     $token = DB::table('sms')
    //         ->where('id',1)
    //         ->first();
    //     $token = $token->token;
        
    //     $user = new Client();
    //     $headers = [
    //         'Authorization' => "Bearer {$token}"
    //     ];
    //     $options1 = [
    //         'multipart' => [
    //           [
    //             'name' => 'mobile_phone',
    //             'contents' => "{$number}"
    //           ],
    //           [
    //             'name' => 'message',
    //             'contents' => "ytest.uz saytidagi tasdiqlash kodingiz: {$code}"
    //           ],
    //           [
    //             'name' => 'from',
    //             'contents' => '4546'
    //           ],
    //           [
    //             'name' => 'callback_url',
    //             'contents' => 'http://0000.uz/test.php'
    //           ]
    //       ]];
    //     $request = new \GuzzleHttp\Psr7\Request('POST', 'notify.eskiz.uz/api/message/sms/send', $headers);
    //     $res = $user->sendAsync($request,$options1)->wait();
    //     $response =  json_decode($res->getBody());
    //     if ($response->status == "token-not-provided") {
            
    //         $headers = [
    //             'Authorization' => "Bearer {$data->token}"
    //         ];
    //         $request = new \GuzzleHttp\Psr7\Request('POST', 'notify.eskiz.uz/api/message/sms/send', $headers);
    //         $res = $user->sendAsync($request,$options1)->wait();
    //         return view('user.sms_conf',['code'=>$code]);
    //     }
    //     else{
    //         return view('user.sms_conf',['code'=>$code]);
    //     }

    // }
}
