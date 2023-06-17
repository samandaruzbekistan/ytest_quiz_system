<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApelsinController extends Controller
{
    public function Info(Request $req): JsonResponse
    {
        $phone = $req->phone;
        $user = DB::table('users')
            ->where('id',$phone)
            ->first();
        if(!empty($user)){
            $response = [
                "status" => true,
                "error" => null,
                "data" => [
                    'fullName'=>$user->full_name,
                    'phone'=>$user->phone,
                    'balance'=>$user->money
                ]                
            ];
            return response()->json($response);
        }
        else{
            $response = [
                'status' => false
            ];
            return response()->json($response);
        }
    }

    public function Pay(Request $req)
    {
        $phone = $req->phone;
        $price1 = $req->amount;
        $transactionId = $req->transactionId;
        $user = DB::table('users')
            ->where('id',$phone)
            ->first();
        if (empty($user)) {
            return response()->json(['status' => false]);
        }
        $order = DB::table('orders')
            ->where('user_id',$phone)
            ->first();
        if (!empty($order)) {
            DB::table('orders')
                ->where('user_id',$phone)
                ->delete();
        }

        
        $price = $user->money + $price1;
        DB::table('users')
            ->where('id',$user->id)
            ->update([
                'money'=> $price
            ]);
        DB::table('apelsin')
            ->insert([
                'phone'=>$phone,
                'transactionId'=>$transactionId,
                'price'=>$price1
            ]);

        return response()->json(['status' => true]);
        
    }
}
