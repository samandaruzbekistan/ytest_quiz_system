<?php
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaynetController;
use App\Http\Controllers\ClickController;
use App\Http\Controllers\ApelsinController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('payme', [PaymentController::class, 'Pay']);

Route::post('prepare', [ClickController::class, 'Prepare']);
Route::post('complete', [ClickController::class, 'Complete']);

Route::post('apelsinInfo', [ApelsinController::class, 'Info']);

Route::post('apelsinPay', [ApelsinController::class, 'Pay']);

Route::post('paynet', [PaynetController::class, 'Paynet']);