<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function Pay(Request $req){
        if ($req->method == "CreateTransaction"){
            $new = date('Y-m-d H:i:s', $req->params['time']); 
            if(empty($req->params['account'])){
                $response = [
                    'id'=>$req->id,
                    'error'=>[
                         'code' => -32504,
                         'message'=>"Недостаточно привилегий для выполнения метода"
                    ]
                ];
                return json_encode($response);
            }
            else{
                $a = $req->params['account'];
                $order = DB::select(DB::raw("select * from orders where `phone` = '{$a['phone']}'"));
                $account = $a;
                $ts = DB::select(DB::raw("select * from transactions where `phone` = {$account['phone']} and `state` = 1"));
                if(empty($order)){
                    $response = [
                        'id'=>$req->id,
                        'error'=>[
                             'code' => -31050,
                             'message'=>[
                                "uz"=>"Buyurtma topilmadi",
                                "ru"=>"Заказ не найден",
                                "en"=>"Order not found"
                             ]
                        ]
                    ];
                    return json_encode($response);
                }
                elseif ("{$order[0]->price}" != "{$req->params['amount']}") {
                    $response = [
                        'id'=>$req->id,
                        'error'=>[
                             'code' => -31001,
                             'message'=>[
                                "uz"=>"Notogri summa",
                                "ru"=>"Неверная сумма",
                                "en"=>"Incorrect amount"
                             ]
                        ]
                    ];
                    return json_encode($response);
                }
                elseif(count($ts) == 0){
                    DB::table('transactions')
                        ->insert([
                            'paycom_transaction_id' => $req->params['id'],
                            'paycom_time' => $req->params['time'],
                            'paycom_time_datetime' => $new,
                            'amount' => $req->params['amount'],
                            'state' => 1,
                            'phone' => "{$account['phone']}"
                        ]);
                    $transaction = DB::table('transactions')
                        ->latest()
                        ->first();
                    
                    $response = ['result' => [
                        "create_time" => $req->params['time'],
                        "transaction" => "$transaction->id",
                        "state" => $transaction->state
                        ]];
                    
                    return json_encode($response);
                }
                elseif((count($ts) == 1) and ($ts[0]->paycom_time == $req->params['time']) and ($ts[0]->paycom_transaction_id == $req->params['id'])){
                    $response = ['result' => [
                        "create_time" => $req->params['time'],
                        "transaction" => "{$ts[0]->id}",
                        "state" => $ts[0]->state
                    ]];
                    return json_encode($response);
                }
                else{
                    // DB::table('transactions')
                    //     ->insert([
                    //         'paycom_transaction_id' => $req->params['id'],
                    //         'paycom_time' => $req->params['time'],
                    //         'paycom_time_datetime' => $new,
                    //         'amount' => $req->params['amount'],
                    //         'state' => 1,
                    //         'phone' => "{$account['phone']}"
                    //     ]);
                    // $transaction = DB::table('transactions')
                    //     ->latest()
                    //     ->first();
                    // $array = [];
                    // foreach ($ts as $key => $value) {
                    //     $array[$key] = [
                    //         "id" => $value->paycom_transaction_id,
                    //         "amount" => $value->amount
                    //     ];
                    // }
                    $response = [
                        'id'=>$req->id,
                        'error'=>[
                             'code' => -31099,
                             'message'=>[
                                "uz"=>"Buyurtma tolovi hozirda amalga oshrilmoqda",
                                "ru"=>"Оплата заказа в данный момент обрабатывается",
                                "en"=>"Order payment is currently being processed"
                             ]
                        ]
                    ];
                    return json_encode($response);
                }
            }
        }
        elseif($req->method == "CheckPerformTransaction"){
            if(empty($req->params['account'])){
                $response = [
                    'id'=>$req->id,
                    'error'=>[
                         'code' => -32504,
                         'message'=>"Недостаточно привилегий для выполнения метода"
                    ]
                ];
                return json_encode($response);
            }
            else{
                $a = $req->params['account'];
                $t = DB::select(DB::raw("select * from orders where `phone` = '{$a['phone']}'"));
                if(empty($t)){
                    $response = [
                        'id'=>$req->id,
                        'error'=>[
                             'code' => -31050,
                             'message'=>[
                                "uz"=>"Buyurtma topilmadi",
                                "ru"=>"Заказ не найден",
                                "en"=>"Order not found"
                             ]
                        ]
                    ];
                    return json_encode($response);
                }
                elseif ("{$t[0]->price}" != "{$req->params['amount']}") {
                    $response = [
                        'id'=>$req->id,
                        'error'=>[
                             'code' => -31001,
                             'message'=>[
                                "uz"=>"Notogri summa",
                                "ru"=>"Неверная сумма",
                                "en"=>"Incorrect amount"
                             ]
                        ]
                    ];
                    return json_encode($response);
                }
            }
            $t = DB::select(DB::raw("select * from orders where `phone` = '{$a['phone']}' and price = {$req->params['amount']}"));
            $response = [
                
                    'result'=>[
                        'allow'=>true,
                        'detail'=>[
                            "receipt_type" => 0
                        ],
                        'items'=>[
                            [
                                'title'=>'Test',
                                'price'=>$t[0]->price,
                                'count'=>1,
                                'code'=>"10899001001000000",
                                "vat_percent"=> 0,
                                "package_code" => "190309"
                            ]
                        ]
                    ]
                    
                
            ];
            return json_encode($response);
        }
        elseif($req->method == "PerformTransaction"){
            $ldate = date('Y-m-d H:i:s');
            $t = DB::select(DB::raw("select * from transactions where `paycom_transaction_id` = '{$req->params['id']}'"));
            if(empty($t)){
                $response = [
                    'id'=>$req->id,
                    'error'=>[
                         'code' => -32504,
                         'message'=>"Недостаточно привилегий для выполнения метода"
                    ]
                ];
                return json_encode($response);
            }
            elseif (count($t) == 1 and $t[0]->state == 1){
                DB::table('transactions')
                    ->where('paycom_transaction_id', $req->params['id'])
                    ->update([
                        'state' => 2,
                        'perform_time' => $ldate,
                        'perform_time_unix' => intval(microtime(true) * 1000)
                    ]);
                $transaction = DB::table('transactions')
                    ->where('paycom_transaction_id', $req->params['id'])
                    ->first();
                $user = DB::table('users')
                    ->where('phone',$transaction->phone)
                    ->first();
                $price = $user->money + ($transaction->amount / 100);
                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'money' => $price
                    ]);
                DB::table('orders')
                    ->where('user_id',$user->id)
                    ->delete();
                $response = [
                    'result' => [
                        'transaction' => "{$transaction->id}",
                        'perform_time' => $transaction->perform_time_unix,
                        'state' => $transaction->state
                    ]
                ];
            }
            elseif($t[0]->state == 2){
                $response = [
                    'result' => [
                        'transaction' => "{$t[0]->id}",
                        'perform_time' => $t[0]->perform_time_unix,
                        'state' => $t[0]->state
                        ]
                    ];
            }
            return json_encode($response);
        }
        elseif($req->method == "CheckTransaction"){
            $ldate = date('Y-m-d H:i:s');
            $transaction = DB::table('transactions')
                ->where('paycom_transaction_id', $req->params['id'])
                ->first();
            if(empty($transaction)){
                $response = [
                    'id'=>$req->id,
                    'error'=>[
                         'code' => -32504,
                         'message'=>"Недостаточно привилегий для выполнения метода"
                    ]
                ];
                return json_encode($response);
            }
            else{
                $response = [
                    'result' => [
                        "create_time" => $transaction->paycom_time,
                        "perform_time" => $transaction->perform_time_unix,
                        "cancel_time" => $transaction->cancel_time,
                        'transaction' => "$transaction->id",
                        'state' => $transaction->state,
                        "reason" => $transaction->reason
                    ]
                ];
                return json_encode($response);
            }
        }
        elseif($req->method == "CancelTransaction"){
            $ldate = date('Y-m-d H:i:s');
            $t = DB::table('transactions')
                ->where('paycom_transaction_id', $req->params['id'])
                ->first();
            if(empty($t)){
                $response = [
                    'id'=>$req->id,
                    'error'=>[
                         'code' => -32504,
                         'message'=>"Недостаточно привилегий для выполнения метода"
                    ]
                ];
                return json_encode($response);
            }
            elseif ($t->state == 1) {
                DB::table('transactions')
                    ->where('paycom_transaction_id', $req->params['id'])
                    ->update([
                        'reason' => $req->params['reason'],
                        'cancel_time' => intval(microtime(true) * 1000),
                        'state' => -1
                    ]);
                $t = DB::table('transactions')
                    ->where('paycom_transaction_id', $req->params['id'])
                    ->first();
                DB::table('orders')
                    ->where('phone', $t->phone)
                    ->delete();
                $response = [
                    'result' => [
                        "state" => $t->state,
                        "cancel_time" => $t->cancel_time,
                        "transaction" => "{$t->id}"
                    ]
                ];
            }
            elseif(($t->state == -1) or ($t->state == -2)){
                $response = [
                    'result' => [
                        "state" => $t->state,
                        "cancel_time" => $t->cancel_time,
                        "transaction" => "{$t->id}"
                    ]
                ];
            }
            else{
                DB::table('transactions')
                    ->where('paycom_transaction_id', $req->params['id'])
                    ->update([
                        'reason' => $req->params['reason'],
                        'cancel_time' => intval(microtime(true) * 1000),
                        'state' => -2
                    ]);
                $t = DB::table('transactions')
                    ->where('paycom_transaction_id', $req->params['id'])
                    ->first();
                DB::table('orders')
                    ->where('phone', $t->phone)
                    ->delete();
                $response = [
                    'result' => [
                        "state" => $t->state,
                        "cancel_time" => $t->cancel_time,
                        "transaction" => "{$t->id}"
                    ]
                ];
            }
            return json_encode($response);
        }
        elseif ($req->method == "GetStatement") {
            $response = [
                'id'=>$req->id,
                'error'=>[
                     'code' => -32504,
                     'message'=>"Недостаточно привилегий для выполнения метода"
                ]
            ];
            return json_encode($response);
        }
        elseif ($req->method == "ChangePassword") {
            $response = [
                'id'=>$req->id,
                'error'=>[
                     'code' => -32504,
                     'message'=>"Недостаточно привилегий для выполнения метода"
                ]
            ];
            return json_encode($response);
        }
    }

    
}

