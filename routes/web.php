<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\NationalController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\BlockController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserController::class, 'user_home'])->name('user-home');
Route::get('/news', [UserController::class, 'news'])->name('news');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::get('/categories', [UserController::class, 'categories'])->name('categories');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login_reg', [UserController::class, 'reg'])->name('reg');
Route::post('/user_check', [UserController::class, 'user_check'])->name('user_check');
Route::get('/user_info', [UserController::class, 'information'])->name('information');
Route::post('/order_reg', [UserController::class, 'order_reg'])->name('order_reg');
Route::get('/science', [UserController::class, 'sciense'])->name('sciense');
Route::get('/buy/{science_id}', [UserController::class, 'buy'])->name('buy');
Route::get('/payment', [UserController::class, 'payment'])->name('Payment');
Route::get('/my_results', [UserController::class, 'my_results'])->name('my_results');
Route::post('/quiz-check', [UserController::class, 'check_test'])->name('check_test');
Route::get('/playtest/{id}', [UserController::class, 'play'])->name('play');
Route::post('/reset-check', [UserController::class, 'reset'])->name('reset');
Route::get('/reset-confirm/{hash}', [UserController::class, 'reset_conf'])->name('reset_conf');
Route::post('/reset-reg', [UserController::class, 'reset_reg'])->name('reset_reg');

Route::post('/send-sms', [SmsController::class, 'SendSms'])->name('sendSms');
Route::get('/send-sms/{phone}/{user_id}', [SmsController::class, 'reset'])->name('reset_sms');


Route::get('/select-uni', [UserController::class, 'select_block'])->name('select_block');
Route::get('/select-dir', [UserController::class, 'get_dir'])->name('get_dir');
Route::get('/set_dir', [UserController::class, 'set_dir'])->name('set_dir');
Route::get('/all_dir', [UserController::class, 'dir'])->name('dirs');
Route::get('/add_session', [UserController::class, 'add_session'])->name('add_session');
Route::post('/play_block', [UserController::class, 'play_block'])->name('play_block');
Route::post('/check-block', [UserController::class, 'check_block'])->name('check_block');


Route::get('/admin', function () {
    return view('admin.login');
});

Route::get('/reset-phone', function () {
    return view('user.reset');
})->name('reset_form');

// Route::get('/uni-name', [AdminController::class, 'uni_name']);

Route::post('/admin-check', [AdminController::class, 'admin_check']);
Route::get('/admin-home', [AdminController::class, 'admin_home'])->name('admin-home');
Route::get('/new-compulsory', [AdminController::class, 'new_compulsory'])->name('new-compulsory');
Route::post('/new_compulsory_reg', [AdminController::class, 'new_compulsory_reg'])->name('new_compulsory_reg');
Route::get('/view_subject_compulsory/{id}', [AdminController::class, 'view_subject_compulsory'])->name('view_subject_compulsory');
Route::get('/new_compulsory_quiz/{subject_id}', [AdminController::class, 'new_compulsory_quiz'])->name('new_compulsory_quiz');
Route::post('/new_compulsory_quiz_reg', [AdminController::class, 'new_compulsory_quiz_reg'])->name('new_compulsory_quiz_reg');
Route::delete('/compulsory_delete', [AdminController::class, 'compulsory_delete'])->name('compulsory_delete');
Route::get('/compulsory_view/{id}', [AdminController::class, 'compulsory_view'])->name('compulsory_view');
Route::get('/all-users', [AdminController::class, 'users'])->name('all_users');
Route::post('/all-update_money', [AdminController::class, 'update_money'])->name('update_money');
Route::get('/all-pricies', [AdminController::class, 'pricies'])->name('pricies');
Route::post('/all-update_price', [AdminController::class, 'update_price'])->name('update_price');


Route::get('/new-subject', [SubjectController::class, 'new_subject'])->name('new-subject');
Route::post('/new_subject_reg', [SubjectController::class, 'new_subject_reg'])->name('new_subject_reg');
Route::get('/view_subject/{id}', [SubjectController::class, 'view_subject'])->name('view_subject');
Route::get('/new_subject_quiz/{subject_id}', [SubjectController::class, 'new_subject_quiz'])->name('new_subject_quiz');
Route::post('/new_subject_quiz_reg', [SubjectController::class, 'new_subject_quiz_reg'])->name('new_subject_quiz_reg');
Route::delete('/subject_delete', [SubjectController::class, 'subject_delete'])->name('subject_delete');
Route::get('/subject_view/{id}', [SubjectController::class, 'subject_view'])->name('subject_view');


Route::get('/universities', [DirectionController::class, 'univeresities'])->name('universities');
Route::post('/new_uni_reg', [DirectionController::class, 'new_uni_reg'])->name('new_uni_reg');
Route::get('/directions', [DirectionController::class, 'directions'])->name('directions');
Route::get('/new_direct', [DirectionController::class, 'new_direct'])->name('new_direct');
Route::post('/new_direct_reg', [DirectionController::class, 'new_direct_reg'])->name('new_direct_reg');
Route::delete('/direct_delete', [DirectionController::class, 'direct_delete'])->name('direct_delete');
Route::get('/direct/{id}', [DirectionController::class, 'directFilter'])->name('directFilter');
Route::delete('/deleteUni', [DirectionController::class, 'deleteUni'])->name('deleteUni');
Route::get('/directions-edit/{id}', [DirectionController::class, 'edit'])->name('dir_edit');
Route::post('/directions-update', [DirectionController::class, 'update'])->name('dir_edit_save');

Route::get('/national', [NationalController::class, 'exam_days'])->name('exam_days');
Route::get('/exam_days', [NationalController::class, 'all_subject'])->name('all_exam');
Route::post('/new-national', [NationalController::class, 'new_subject'])->name('new-national');
Route::post('/new-national-day', [NationalController::class, 'new_exam_day'])->name('new-national-day');
Route::get('/edit-national/{id}', [NationalController::class, 'edit'])->name('edit_n');
Route::delete('/national_delete', [NationalController::class, 'national_delete'])->name('national_delete');
Route::post('/national_update', [NationalController::class, 'national_update'])->name('national_update');
Route::get('/national_view/{id}', [NationalController::class, 'national_view'])->name('national_view');
Route::delete('/n_quiz_delete', [NationalController::class, 'n_quiz_delete'])->name('n_quiz_delete');
Route::get('/new_n_quiz/{id}/{type}', [NationalController::class, 'new_n_quiz'])->name('new_n_quiz');
Route::post('/new_n_quiz_reg', [NationalController::class, 'new_n_quiz_reg'])->name('new_n_quiz_reg');
Route::post('/n_quiz_update', [NationalController::class, 'n_quiz_update'])->name('n_quiz_update');
Route::get('/n_quiz_view/{id}', [NationalController::class, 'n_quiz_view'])->name('n_quiz_view');
Route::get('/n_quiz_edit/{id}', [NationalController::class, 'n_quiz_edit'])->name('n_quiz_edit');
Route::get('/n_results', [NationalController::class, 'n_results'])->name('n_results');
Route::get('/n_results_filter', [NationalController::class, 'n_results_filter'])->name('n_results_filter');
Route::get('/admin_check/{exam_id}', [NationalController::class, 'admin_check'])->name('admin_check');
Route::post('/edit-day', [NationalController::class, 'edit_exam_day_reg'])->name('edit_exam_day_reg');
Route::get('/edit_exam_day/{id}', [NationalController::class, 'edit_exam_day'])->name('edit_exam_day');

Route::get('/new-api', [UserController::class, 'apies'])->name('api');


Route::get('/new-add', [NewsController::class, 'Form'])->name('new_form');
Route::get('/new-show', [NewsController::class, 'Show'])->name('news_admin');
Route::post('/new-reg', [NewsController::class, 'Reg'])->name('news_reg');
Route::get('/new-view/{id}', [NewsController::class, 'View'])->name('news_view');
Route::get('/new-edit/{id}', [NewsController::class, 'Edit'])->name('news_edit');
Route::post('/new-delete', [NewsController::class, 'Delete'])->name('news_delete');
Route::post('/new-edit-save', [NewsController::class, 'Update'])->name('news_edit_save');



Route::get('/block-days', [BlockController::class, 'exam_days'])->name('b_exam_days');
Route::post('/new-day', [BlockController::class, 'new_exam_day'])->name('new-block-day');
Route::get('/block-sale', [BlockController::class, 'sale']);