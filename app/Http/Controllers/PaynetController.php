<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PaynetController extends Controller
{
    public function Paynet(Request $req): JsonResponse
    {
        if ($req->method == "GetInformation"){
            $params = $req->params;
            $user = DB::table('users')
                ->where('phone',$params['fields']['phone'])
                ->first();
            if (!empty($user)) {
                $now = date('Y-m-d H:i:s');
                $response = [
                    "jsonrpc" => "2.0",
                    "id" => $req->id,
                    "result" => [
                        "status" => "Успех",
                        "timestamp" => "{$now}",
                        "fields" => [
                            "balance" => $user->money,
                            "name" => $user->full_name
                        ]
                    ]
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "jsonrpc" => "2.0",
                    "id" => $req->id,
                    "error" => [
                        "code" => 302,
                        "message" => "Клиент не найден"
                    ]
                ];
                return response()->json($response);
            }
        }
        elseif($req->method == "PerformTransaction"){
            $params = $req->params;
            $user = DB::table('users')
                ->where('phone',$params['fields']['phone'])
                ->first();
            $transaction = DB::table('paynet')
                ->where('transactionId',$params['transactionId'])
                ->first();
            if (empty($user)) {
                $response = [
                    "jsonrpc" => "2.0",
                    "id" => $req->id,
                    "error" => [
                        "code" => 302,
                        "message" => "Клиент не найден"
                    ]
                ];
                return response()->json($response);
            }
            if (!empty($transaction)) {
                $response = [
                    "jsonrpc" => "2.0",
                    "id" => $req->id,
                    "error" => [
                        "code" => 201,
                        "message" => "Транзакция уже существует"
                    ]
                ];
                return response()->json($response);
            }
            if (!empty($user)) {
                $amount = $params['amount'];
                $phone = $params['fields']['phone'];
                $order = DB::table('orders')
                    ->where('phone',$phone)
                    ->first();
                if (!empty($order)) {
                    DB::table('orders')
                        ->where('user_id',$phone)
                        ->delete();
                }
                $price = $user->money + $amount;
                DB::table('users')
                    ->where('id',$user->id)
                    ->update([
                        'money'=> $price
                    ]);
                DB::table('paynet')
                    ->insert([
                        'transactionId'=>$params['transactionId'],
                        'transactionTime' => date('Y-m-d H:i:s'),
                        'phone'=>$phone,
                        'amount'=>$amount,
                        'status' => 1
                    ]);
                $tr = DB::table('paynet')
                    ->latest()
                    ->first();
                $now = date('Y-m-d H:i:s');
                $response = [
                    "jsonrpc" => "2.0",
                    "id" => $req->id,
                    "result" => [
                        "timestamp" => "{$now}",
                        'providerTrnId' => $tr->id,
                        "fields" => [
                            "status" => true
                        ]
                    ]
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "jsonrpc" => "2.0",
                    "id" => $req->id,
                    "error" => [
                        "code" => 302,
                        "message" => "Клиент не найден"
                    ]
                ];
                return response()->json($response);
            }
        }
        elseif ($req->method == "CheckTransaction") {
            $params = $req->params;
            $transaction = DB::table('paynet')
                ->where('transactionId',$params['transactionId'])
                ->first();
            if (empty($transaction)) {
                $response = [
                    "jsonrpc" => "2.0",
                    "id" => $req->id,
                    "error" => [
                        "code" => 203,
                        "message" => "Транзакция не найдена"
                    ]
                ];
                return response()->json($response);
            }
            else {
                $now = date('Y-m-d H:i:s');
                $response = [
                    "jsonrpc" => "2.0",
                    "id" => $req->id,
                    "result" => [
                        "transactionState" => $transaction->status,
                        'timestamp' => "{$now}",
                        "providerTrnId" => $transaction->id
                    ]
                ];
                return response()->json($response);
            }
        }
        elseif ($req->method == "CancelTransaction") {
            $params = $req->params;
            $transaction = DB::table('paynet')
                ->where('transactionId',$params['transactionId'])
                ->first();
            if (empty($transaction)) {
                $response = [
                    "jsonrpc" => "2.0",
                    "id" => $req->id,
                    "error" => [
                        "code" => 203,
                        "message" => "Транзакция не найдена"
                    ]
                ];
                return response()->json($response);
            }
            else {
                $now = date('Y-m-d H:i:s');
                DB::table('paynet')
                    ->where('transactionId',$params['transactionId'])
                    ->update([
                        'status' => 2
                    ]);
                $tr = DB::table('paynet')
                    ->latest()
                    ->first();
                $now = date('Y-m-d H:i:s');
                $response = [
                    "jsonrpc" => "2.0",
                    "id" => $req->id,
                    "result" => [
                        'providerTrnId' => $tr->id,
                        "timestamp" => "{$now}",
                        "transactionState" => $tr->status
                    ]
                ];
                return response()->json($response);
            }
        }
        elseif ($req->method == "GetStatement") {
            $params = $req->params;
            $transactions = DB::select(DB::raw("select amount,id as providerTrnId, transactionId, created_at as `timestamp` from paynet where (created_at BETWEEN '{$params['dateFrom']}' AND '{$params['dateTo']}')"));
            $response = [
                "jsonrpc" => "2.0",
                "id" => $req->id,
                "result" => [
                    'statements' => $transactions
                ]
            ];
            return response()->json($response);
        }
        elseif ($req->method == "ChangePassword") {
            $response = [
                "jsonrpc" => "2.0",
                "id" => $req->id,
                "result" => 'success'
            ];
            return response()->json($response);
        }
    }
}

