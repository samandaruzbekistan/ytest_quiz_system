<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClickController extends Controller
{
    // const STATUS_CANCEL = -1;
    // const STATUS_INACTIVE = 0;
    // const STATUS_ACTIVE = 1;
    // const SIGN = -1;
    // const AMOUNT = -2;
    // const ACTION = -3;
    // const ALREADY_PAID = -4;
    // const ORDER_NOT_FOUND = -5;
    // const TRANSACTION_NOT_FOUND = -6;
    // const UPDATE_FAILED = -7;
    // const REQUEST_ERROR = -8;
    // const TRANSACTION_CANCELLED = -9;

    public function Prepare(Request $request): JsonResponse 
    {
        $result = [
            'click_trans_id' => $request->click_trans_id,
            'merchant_trans_id' => $request->merchant_trans_id,
        ];
        $order = DB::table('orders')
            ->where('phone', $request->merchant_trans_id)
            ->first();
        $transaction = DB::table('click_transactions')
            ->where('click_trans_id', $request->click_trans_id)
            ->first();
        if ($transaction !== NULL) {
            if ($transaction->status == -1) {
                //Transaction cancelled
                return response()->json([
                    'error' => -9,
                    'error_note' => 'Transaction cancelled',
                ]);
            } else {
                //Already paid
                return response()->json([
                    'error' => -4,
                    'error_note' => 'Already paid',
                ]);
            }
        }
        if ($request->error != 0) {
            //Request error
            return response()->json([
                'error' => -3,
                'error_note' => 'Request error',
            ]);
        }
        if ($request->action != 0) {
            //Action not found
            return response()->json([
                'error' => -8,
                'error_note' => 'Action not found',
            ]);
        }
        if (!$order) {
            $result['error'] = -5;
            $result['error_note'] = "Order not found!";
            return response()->json($result);
        }
        DB::table('click_transactions')
            ->insert([
                'click_trans_id' => $request->click_trans_id,
                'service_id' => 25570,
                'click_paydoc_id' => $request->click_paydoc_id,
                'merchant_trans_id' => $order->id,
                'sign_time' => $request->sign_time,
                'amount' => $request->amount,
                'status' => 0,
                'action' => $request->action,
                'error' => $request->error,
                'error_note' => $request->error_note,
                'sign_string' => md5(
                    $request->click_trans_id .
                    "25570" .
                    "gZ59LrLGozARzk".
                    $request->merchant_trans_id .
                    ($request->action == 1 ? $request->merchant_prepare_id : '') .
                    $request->amount .
                    $request->action .
                    $request->sign_time
                )
            ]);
        $transaction = DB::table('click_transactions')
            ->where('click_trans_id', $request->click_trans_id)
            ->first();
        $result['error'] = 0;
        $result['error_note'] = "Success";
        $result['merchant_prepare_id'] = $transaction->id;
        return response()->json($result);
        
    }

    public function Complete(Request $request): JsonResponse
    {
        $result = [
            'click_trans_id' => $request->click_trans_id,
            'merchant_trans_id' => $request->merchant_trans_id,
        ];

        if (empty($request->merchant_prepare_id)) {
            $result['error'] = -8;
            $result['error_note'] = "Request error";
            return response()->json($result);
        }

        $transaction = DB::table('click_transactions')
            ->where('click_trans_id', $request->click_trans_id)
            ->where('click_paydoc_id', $request->click_paydoc_id)
            ->first();

        $order = DB::table('orders')
            ->where('phone', $request->merchant_trans_id)
            ->first();
        // return response()->json($order);
        if ($transaction !== null) {
            # Check for request error to 0!
            if ($request->error == 0) {
                if ($request->amount == $transaction->amount) {
                    if ($transaction->status == 0) {
                        DB::table('click_transactions')
                            ->where('click_trans_id', $request->click_trans_id)
                            ->where('click_paydoc_id', $request->click_paydoc_id)
                            ->update([
                                'status'=>1
                            ]);
                        $user = DB::table('users')
                            ->where('phone',$request->merchant_trans_id)
                            ->first();
                        $price3 = $user->money + $request->amount;
                        DB::table('users')
                            ->where('phone',$request->merchant_trans_id)
                            ->update([
                                'money' => $price3
                            ]);
                        $result['click_trans_id'] = $request->click_trans_id;
                        $result['merchant_trans_id'] = $order->id;
                        $result['merchant_confirm_id'] = $transaction->id;
                        $result['error'] = 0;
                        $result['error_note'] = "Success";
                        $result['merchant_confirm_id'] = $transaction->id;
                        return response()->json($result);
                    } elseif ($transaction->status == -1) {
                        $result['error'] = -9;
                        $result['error_note'] = "Transaction cancelled";
                        return response()->json($result);
                    } elseif ($transaction->status == 1) {
                        $result['error'] = -4;
                        $result['error_note'] = "Already paid";
                        return response()->json($result);
                    } else {
                        $result['error'] = '-n';
                        $result['error_note'] = "Unknown Error";
                        return response()->json($result);
                    }
                } else {
                    if ($transaction->status == 0) {
                        $result['error'] = -2;
                        $result['error_note'] = "Incorrect parameter amount";
                        return response()->json($result);
                    }
                }
            } elseif ($request->error < 0) {
                if ($request->error == -5017) {
                    if ($transaction->status != 1) {
                        DB::table('click_transactions')
                            ->where('click_trans_id', $request->click_trans_id)
                            ->where('click_paydoc_id', $request->click_paydoc_id)
                            ->update([
                                'status'=>-1
                            ]);
                            $result['error'] = -9;
                            $result['error_note'] = "Transaction cancelled";
                            return response()->json($result);
                    } else {
                        $result['error'] = '-n';
                        $result['error_note'] = "Unknown Error";
                        return response()->json($result);
                    }
                } elseif ($request->error == -1 && $transaction->status == 1) {
                    $result['error'] = -4;
                    $result['error_note'] = "Already paid";
                    return response()->json($result);
                } else {
                    $result['error'] = '-n';
                    $result['error_note'] = "Unknown Error";
                    return response()->json($result);
                }
            } else {
                $result['error'] = '-n';
                $result['error_note'] = "Unknown Error";
                return response()->json($result);
            }
        }
        $result['error'] = 0;
        $result['error_note'] = 'Success';
        $result['merchant_confirm_id'] =  $transaction->id;
    
        return response()->json($result);
    }
}
