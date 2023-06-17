<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\SmsController;

class UserController extends Controller
{
    public function login(){
        return view('user.login');
    }

    public function apies()
    {
        $user = new Client();
        $options = [
            'multipart' => [
                [
                    'name' => 'email',
                    'contents' => 'blogerotayorov@gmail.com'
                ],
                [
                    'name' => 'password',
                    'contents' => 'c9ZAinVOdtS6lWJI45HqATdr0T4M5xDKPTW8W2bx'
                ]
            ]];
        $request = new \GuzzleHttp\Psr7\Request('POST', 'notify.eskiz.uz/api/auth/login');
        $res = $user->sendAsync($request,$options)->wait();
        return $res->getBody();
    }

    public function user_home(){
        if (!empty(session('full_name'))) {
            $user = DB::table('users')
                ->where('phone',session('phone'))
                ->first();
            session()->put('balans',$user->money);
        }
        
        return view('user.index');
    }

    public function news(){
        return view('user.news');
    }

    public function my_results(){
        $id = session('user_id');
        $results = DB::table('n_exams')
            ->where('user_id', $id)
            ->latest()
            ->get(['*']);
        return view('user.results',['results'=>$results]);
    }

    public function about(){
        return view('user.about');
    }

    public function contact(){
        return view('user.contact');
    }

    public function categories(){
        $exam_day = DB::table('exam_days')
            ->latest()
            ->first();
        $now = date("Y-m-d");
        $price = DB::table('price')
            ->where('id',1)
            ->first();
        $amount = $price->price;
        if(!empty(session('full_name'))){
            $exam = DB::table('block_exam')
                ->where('user_id', session('user_id'))
                ->where('exam_day_id', $exam_day->id)
                ->first();
            if (!empty($exam)) {
                
                return view('user.categories', ['exam_day' => $exam_day, 'exam' => $exam, 'amount' => $amount]);
            }
        }
        return view('user.categories', ['exam_day' => $exam_day, 'amount' => $amount]);
    }

    public function sciense(){
        if(empty(session('full_name'))){
            return redirect(route('login'));
        }
        else{
            $user = DB::table('users')
                ->where('phone',session('phone'))
                ->first();
            session()->put('balans',$user->money);
            $exam = DB::table('n_exam_days')
                ->latest()
                ->first();
            $subjects = DB::select(DB::raw("select * from n_exams where `user_id` = {$user->id} and exam_day_id = {$exam->id}"));
            $matem = 0;
                $fizika = 0;
                $kimyo = 0;
                $bio = 0;
                $onatili = 0;
            $matem1 = DB::table('national_exam')->where('id',6)->first();
            $fizika1 = DB::table('national_exam')->where('id',7)->first();;
            $kimyo1 = DB::table('national_exam')->where('id',8)->first();;
            $bio1 = DB::table('national_exam')->where('id',9)->first();
            $onatili1 = DB::table('national_exam')->where('id',10)->first();
            if(!empty($subjects)){
            foreach ($subjects as $value) {
                if ($value->science_id == 6) {
                    if ($value->total != 0) {
                        $matem = 2;
                    } else {
                        $matem = 1;
                    }
                }
                elseif ($value->science_id == 7) {
                    if ($value->total != 0) {
                        $fizika = 2;
                    } else {
                        $fizika = 1;
                    }
                }
                elseif ($value->science_id == 8) {
                    if ($value->total != 0) {
                        $kimyo = 2;
                    } else {
                        $kimyo = 1;
                    }
                }
                elseif ($value->science_id == 9) {
                    if ($value->total != 0) {
                        $bio = 2;
                    } else {
                        $bio = 1;
                    }
                }
                elseif ($value->science_id == 10) {
                    if ($value->total != 0) {
                        $onatili = 2;
                    } else {
                        $onatili = 1;
                    }
                }
            }           
        }
        return view('user.sciences',['exam'=>$exam,'subjects' => $subjects, 'matem' => $matem,'fizika' => $fizika,'kimyo' => $kimyo,'bio' => $bio,'onatili' => $onatili,'matem1' => $matem1,'fizika1' => $fizika1,'kimyo1' => $kimyo1,'bio1' => $bio1,'onatili1' => $onatili1]);
        // return ['exam'=>$exam,'subjects' => $subjects, 'matem' => $matem,'fizika' => $fizika,'kimyo' => $kimyo,'bio' => $bio,'onatili' => $onatili];
        }
    }

    public function logout(){
        session()->flush();
        return redirect(route('user-home'));
    }

    public function buy($science_id){
        if(empty(session('full_name'))){
            return redirect(route('login'));
        }
        else{
            $science = DB::table('national_exam')
                ->where('id',$science_id)
                ->first();
            $user = DB::table('users')
                ->where('id',session('user_id'))
                ->first();
            if($science->price > $user->money){
                session()->flash('money_error',"1");
                return redirect(route('sciense'));
            }
            else{
                $exam = DB::table('n_exam_days')
                    ->latest()
                    ->first();
                DB::table('n_exams')
                    ->insert([
                        'date'=>$exam->date,
                        'user_id'=>session('user_id'),
                        'science_id'=>$science_id,
                        'price'=>$science->price,
                        'exam_day_id'=>$exam->id,
                        'name'=>$science->name
                    ]);
                DB::table('n_exam_days')
                    ->where('id',$exam->id)
                    ->update([
                        'count'=>$exam->count + 1,
                        'price'=>$exam->price + $science->price,
                    ]);
                $money = $user->money - $science->price;
                DB::table('users')
                    ->where('id',session('user_id'))
                    ->update([
                        'money' => $money
                    ]);
                return redirect(route('sciense'));
            }
            
        }
    }

    public function reg(Request $req)
    {
        if ($req->code != session('code')) {
            session()->flash('code_error',"1");
            return redirect(route('login'));
        }
        $user = DB::table('users')
            ->where('phone',session('phone'))
            ->first();
        
        if(!empty($user)){
            session()->flash('phone_error',"1");
            return redirect(route('login'));
        }
        else{
            DB::table('users')
                ->insert([
                    'full_name' => session('full_name'),
                    'password' => md5(md5(session('password'))),
                    'phone' => session('phone'),
                ]);
            $user = DB::table('users')
                ->latest()
                ->first();
            // session()->put('full_name', $user->full_name);
            // session()->put('phone', $user->phone);
            session()->put('user_id', $user->id);
            return redirect(route('user-home'));
        }
    }

    public function reset(Request $req)
    {
        $req->validate([
            'phone'=>'required'
        ]);

        $user = DB::table('users')
            ->where('phone',$req->phone)
            ->first();
        
        if (!empty($user)) {
            $link = DB::table('reset_password')
                ->where('user_id', $user->id)
                ->first();
            if (empty($link)) {
                $solt = rand(100,1000);
                $hash = md5(md5($user->phone."{$solt}"));
                DB::table('reset_password')
                    ->insert([
                        'user_id' => $user->id,
                        'hash_phone' => $hash
                    ]);
            } 
            return redirect(route('reset_sms', ['phone'=>$req->phone, 'user_id' => $user->id]));
        }
        else {
            return back()->with('error', '1');
        }
    }

    public function reset_reg(Request $req)
    {
        $req->validate([
            'user_id' => 'required',
            'password'=>'required'
        ]);

        $user = DB::table('users')
            ->where('id', $req->user_id)
            ->first();
        
        if (empty($user)) {
            return abort(404);
        }

        DB::table('reset_password')
            ->where('user_id', $req->user_id)
            ->delete();

        DB::table('users')
            ->where('id', $req->user_id)
            ->update([
                'password' => md5(md5($req->password))
            ]);
        session()->flash('reset', '1');
        return redirect(route('login'));
    }

    public function reset_conf($hash)
    {
        $user = DB::table('reset_password')
            ->where('hash_phone', $hash)
            ->first();
        if (empty($user)) {
            return abort(404);
        }
        return view('user.reset_confirm', ['user_id' => $user->user_id]);
    }

    public function user_check(Request $req){
        $user = DB::table('users')
            ->where('phone',$req->phone)
            ->first();
        if (!empty($user) and  ($user->password == md5(md5($req->password)))){
            session()->put('full_name', $user->full_name);
            session()->put('phone', $user->phone);
            session()->put('user_id', $user->id);
            return redirect(route('user-home'));
        }
        else{
            session()->flash('login_errr',"1");
            return redirect(route('login'));
        }
    }

    public function information(){
        if(empty(session('full_name'))){
            return redirect(route('login'));
        }
        else{
            $user = DB::table('users')
                ->where('phone',session('phone'))
                ->first();
            return view('user.information',['user'=>$user]);
        }
    }

    public function order_reg(Request $req){
        if(empty(session('full_name'))){
            return redirect(route('login'));
        }
        else{
            DB::table('orders')
                ->where('phone',session('phone'))
                ->delete();
            DB::table('orders')
                ->insert([
                    'phone'=>session('phone'),
                    'product_id'=>1,
                    'price'=>$req->price * 100,
                    'user_id'=>session('user_id'),
                    'name'=>"Test"
                ]);
            $user = DB::table('users')
                ->where('phone',session('phone'))
                ->first();
            $order = DB::table('orders')
                ->where('phone',session('phone'))
                ->first();
            return view('user.payment',['user'=>$user,'pay_system'=>"1",'order'=>$order]);
        }
    }

    public function payment(){
        if(empty(session('full_name'))){
            return redirect(route('login'));
        }
        else{
            return view('user.payment');
        }
    }

    public function play($id)
    {
        if(empty(session('full_name'))){
            return redirect(route('login'));
        }
        else{
            $userID = session('user_id');
            $exam = DB::table('n_exam_days')
                ->latest()
                ->first();
            $subject = DB::select(DB::raw("select * from n_exams where `user_id` = {$userID} and exam_day_id = {$exam->id} and `science_id` = {$id} LIMIT 1"));
            if ($subject[0]->total != 0) {
                session()->flash("already","1");
                return redirect(route('sciense'));
            }
            if(empty($subject)){
                return redirect(route('sciense'));
            }
            if ($subject[0]->science_id == 10) {
                $name = $subject[0]->name;
                $quizzes = DB::table('n_quizzes')
                    ->where('exam_id',10)
                    ->get(['*']);
                $answers = [];
                foreach($quizzes as $key) {
                    $answers[] = DB::table('n_answers')
                        ->where('quiz_id',$key->id)
                        ->get(['*'])->shuffle();
                }
                return view('user.play',['name'=>$name,'exam'=>$subject,'quizzes'=>$quizzes, 'answers'=>$answers]);
            }
            else{
                $four_quizzes = DB::select(DB::raw("select * from n_quizzes where `type` = 'open' and `exam_id` = {$id} ORDER BY `id` LIMIT 32;"));
                $six_quizzes = DB::select(DB::raw("select * from n_quizzes where `type` = 'six' and `exam_id` = {$id} ORDER BY `id` LIMIT 3;"));
                $close_quizzes = DB::select(DB::raw("select * from n_quizzes where `type` = 'two' and `exam_id` = {$id} ORDER BY `id` LIMIT 10;"));
                $four_answers = [];
                $six_answers = [];
                $name = $subject[0]->name;
                foreach($four_quizzes as $key) {
                    $four_answers[] = DB::table('n_answers')
                        ->where('quiz_id',$key->id)
                        ->get(['*'])->shuffle();
                }
                foreach($six_quizzes as $key) {
                    $six_answers[] = DB::table('n_answers')
                        ->where('quiz_id',$key->id)
                        ->get(['*'])->shuffle();
                }
                // return ['name'=>$name,'exam'=>$subject,'four_quizzes'=>$four_quizzes,'six_quizzes'=>$six_quizzes,'close_quizzes'=>$close_quizzes,'four_answers'=>$four_answers,'six_answers'=>$six_answers];
                return view('user.play',['name'=>$name,'exam'=>$subject,'four_quizzes'=>$four_quizzes,'six_quizzes'=>$six_quizzes,'close_quizzes'=>$close_quizzes,'four_answers'=>$four_answers,'six_answers'=>$six_answers]);
            }
        }
    }

    public function playtest($id)
    {
        if(empty(session('full_name'))){
            return redirect(route('login'));
        }
        else{
            $userID = session('user_id');
            $exam = DB::table('n_exam_days')
                ->latest()
                ->first();
            $subject = DB::select(DB::raw("select * from n_exams where `user_id` = {$userID} and exam_day_id = {$exam->id} and `science_id` = {$id} LIMIT 1"));
            if ($subject[0]->total != 0) {
                session()->flash("already","1");
                return redirect(route('sciense'));
            }
            if(empty($subject)){
                return redirect(route('sciense'));
            }
            if ($subject[0]->science_id == 10) {
                $name = $subject[0]->name;
                $quizzes = DB::table('n_quizzes')
                    ->where('exam_id',10)
                    ->get(['*']);
                $answers = [];
                foreach($quizzes as $key) {
                    $answers[] = DB::table('n_answers')
                        ->where('quiz_id',$key->id)
                        ->get(['*'])->shuffle();
                }
                return view('user.play',['name'=>$name,'exam'=>$subject,'quizzes'=>$quizzes, 'answers'=>$answers]);
            }
            else{
                $four_quizzes = DB::select(DB::raw("select * from n_quizzes where `type` = 'open' and `exam_id` = {$id} ORDER BY `id` LIMIT 32;"));
                $six_quizzes = DB::select(DB::raw("select * from n_quizzes where `type` = 'six' and `exam_id` = {$id} ORDER BY `id` LIMIT 3;"));
                $close_quizzes = DB::select(DB::raw("select * from n_quizzes where `type` = 'close' and `exam_id` = {$id} ORDER BY `id` LIMIT 10;"));
                $four_answers = [];
                $six_answers = [];
                $name = $subject[0]->name;
                foreach($four_quizzes as $key) {
                    $four_answers[] = DB::table('n_answers')
                        ->where('quiz_id',$key->id)
                        ->get(['*'])->shuffle();
                }
                foreach($six_quizzes as $key) {
                    $six_answers[] = DB::table('n_answers')
                        ->where('quiz_id',$key->id)
                        ->get(['*'])->shuffle();
                }
                return view('user.play',['name'=>$name,'exam'=>$subject,'four_quizzes'=>$four_quizzes,'six_quizzes'=>$six_quizzes,'close_quizzes'=>$close_quizzes,'four_answers'=>$four_answers,'six_answers'=>$six_answers]);
            }
        }
    }
 
    public function check_test(Request $req)
    {
        if($req->science_id == 10){
            // return $req;
            $e1 = 0;
            $e2 = 0;
            $e3 = 0;
            $e4 = 0;
            $userID = session('user_id');
            for ($i=1; $i < 53; $i++) {
                $f = "four".$i; 
                $fr = "close".$i; 
                $q_id = "close_id".$i; 
                if (isset($req->$f)) {
                    $answer = DB::table('n_answers')
                        ->where('id',$req->$f)
                        ->first();
                    if ($answer->correct == 1) {
                        if (($i > 0) and ($i < 21)) {
                            $e1 = $e1 + $answer->ball;
                        }
                        elseif (($i > 20) and ($i < 41)) {
                            $e2 = $e2 + $answer->ball;
                        }
                        elseif (($i > 40) and ($i < 51)) {
                            $e3 = $e3 + $answer->ball;
                        }
                    }
                } 
                elseif (isset($req->$fr)) {
                    DB::table('temp_answers')
                        ->insert([
                            'answer' => $req->$fr,
                            'photo' => "no_photo",
                            'quiz_id' => $req->$q_id,
                            'exam_id' => $req->exam_id,
                            'user_id' => $userID
                        ]);
                }                      
            }
            DB::table('n_exams')
                ->where('id',$req->exam_id)
                ->update([
                    'ball' => $e1,
                    'six' => $e2,
                    'writing' => $e3,
                    'total' => $e1+$e2+$e3
                ]);
            return view('user.result', ['e1' => $e1,'e2' => $e2, 'e3' => $e3, 'max' => 129, 'onatili' => 1]);
        }
        else {
            $e1 = 0;
            $e2 =0;
            $o =0;
            $e1_count = 0;
            $e2_count = 0;
            for ($i=1; $i < 33; $i++) {
                $f = "four".$i; 
                if (isset($req->$f)) {
                    $answer = DB::table('n_answers')
                        ->where('id',$req->$f)
                        ->first();
                    if ($answer->correct == 1) {
                        $e1 = $e1 + $answer->ball;
                        $e1_count = $e1_count + 1;
                    }
                }                       
            }
            for ($i=33; $i < 36; $i++) { 
                $f = "four".$i; 
                if (isset($req->$f)) {
                    $answer = DB::table('n_answers')
                        ->where('id',$req->$f)
                        ->first();
                    if ($answer->correct == 1) {
                        $e2 = $e2 + $answer->ball;
                        $e2_count = $e2_count + 1;
                    }
                }    
            }
            for ($i=1; $i < 11; $i++) { 
                $f = "close_id".$i; 
                $a = "a".$i;
                $b = "b".$i;
                $quiz = DB::table('n_quizzes')
                    ->where('id',$req->$f)
                    ->first();
                $answers = DB::table('n_answers')
                    ->where('quiz_id',$quiz->id)
                    ->get(['*']);
                if ($req->$a == $answers[0]->answer) {
                    $o = $o + $quiz->ball;
                } 
                if ($req->$b == $answers[1]->answer) {
                    $o = $o + $quiz->ball2;
                } 
            }
                                                     
            DB::table('n_exams')
                ->where('id',$req->exam_id)
                ->update([
                    'ball' => $e1,
                    'six' => $e2,
                    'check_ball' => $o,
                    'is_check' => 1,
                    'total' => $e1+$e2+$o
                ]);
            return view('user.result', ['e1' => $e1,'e2' => $e2, 'o' => $o, 'max' => 100]);
        }
    }

    public function check_tests(Request $req)
    {
        if($req->science_id == 10){
            $correct = 0;
            $correct_count =0;
            $userID = session('user_id');
            for ($i=1; $i < 53; $i++) {
                $f = "four".$i; 
                $fr = "close".$i; 
                $q_id = "close_id".$i; 
                if (isset($req->$f)) {
                    $answer = DB::table('n_answers')
                        ->where('id',$req->$f)
                        ->first();
                    if ($answer->correct == 1) {
                        $correct = $correct + $answer->ball;
                        $correct_count = $correct_count + 1;
                    }
                } 
                elseif (isset($req->$fr)) {
                    DB::table('temp_answers')
                        ->insert([
                            'answer' => $req->$fr,
                            'photo' => "no_photo",
                            'quiz_id' => $req->$q_id,
                            'exam_id' => $req->exam_id,
                            'user_id' => $userID
                        ]);
                }                      
            }
            DB::table('n_exams')
                ->where('id',$req->exam_id)
                ->update([
                    'ball' => $correct,
                    'total' => $correct
                ]);
            return view('user.result', ['correct' => $correct, 'count' => $correct_count]);
        }
        else {
        $answers = [];
        $correct = 0;
        $incorrect = 0;
        $correct_count = 0;
        $incorrect_count = 0;
        for ($i=1; $i < 36; $i++) {
            $f = "four".$i; 
            if (isset($req->$f)) {
                $answer = DB::table('n_answers')
                    ->where('id',$req->$f)
                    ->first();
                if ($answer->correct == 1) {
                    $correct = $correct + $answer->ball;
                    $correct_count = $correct_count + 1;
                }
            }                       
        }
        $close1 = "no_photo";
        $close2 = "no_photo";
        $close3 = "no_photo";
        $close4 = "no_photo";
        $close5 = "no_photo";
        $close6 = "no_photo";
        $close7 = "no_photo";
        $close8 = "no_photo";
        $close9 = "no_photo";
        $close10 = "no_photo";
        if ($req->hasFile('close_photo1')){
            $photo = $req->file('close_photo1');
            $name = md5(microtime());
            $file = $req->file('close_photo1')->extension();
            $dir = "temp_images/";
            $photo->move($dir, $name.".".$file);
            $close1 = $name.".".$file;
        }
        if ($req->hasFile('close_photo2')){
            $photo = $req->file('close_photo2');
            $name = md5(microtime());
            $file = $req->file('close_photo2')->extension();
            $dir = "temp_images/";
            $photo->move($dir, $name.".".$file);
            $close2 = $name.".".$file;
        }
        if ($req->hasFile('close_photo3')){
            $photo = $req->file('close_photo3');
            $name = md5(microtime());
            $file = $req->file('close_photo3')->extension();
            $dir = "temp_images/";
            $photo->move($dir, $name.".".$file);
            $close3 = $name.".".$file;
        }
        if ($req->hasFile('close_photo4')){
            $photo = $req->file('close_photo4');
            $name = md5(microtime());
            $file = $req->file('close_photo4')->extension();
            $dir = "temp_images/";
            $photo->move($dir, $name.".".$file);
            $close4 = $name.".".$file;
        }
        if ($req->hasFile('close_photo5')){
            $photo = $req->file('close_photo5');
            $name = md5(microtime());
            $file = $req->file('close_photo5')->extension();
            $dir = "temp_images/";
            $photo->move($dir, $name.".".$file);
            $close5 = $name.".".$file;
        }
        if ($req->hasFile('close_photo6')){
            $photo = $req->file('close_photo6');
            $name = md5(microtime());
            $file = $req->file('close_photo6')->extension();
            $dir = "temp_images/";
            $photo->move($dir, $name.".".$file);
            $close6 = $name.".".$file;
        }
        if ($req->hasFile('close_photo7')){
            $photo = $req->file('close_photo7');
            $name = md5(microtime());
            $file = $req->file('close_photo7')->extension();
            $dir = "temp_images/";
            $photo->move($dir, $name.".".$file);
            $close7 = $name.".".$file;
        }
        if ($req->hasFile('close_photo8')){
            $photo = $req->file('close_photo8');
            $name = md5(microtime());
            $file = $req->file('close_photo8')->extension();
            $dir = "temp_images/";
            $photo->move($dir, $name.".".$file);
            $close8 = $name.".".$file;
        }
        if ($req->hasFile('close_photo9')){
            $photo = $req->file('close_photo9');
            $name = md5(microtime());
            $file = $req->file('close_photo9')->extension();
            $dir = "temp_images/";
            $photo->move($dir, $name.".".$file);
            $close9 = $name.".".$file;
        }
        if ($req->hasFile('close_photo10')){
            $photo = $req->file('close_photo10');
            $name = md5(microtime());
            $file = $req->file('close_photo10')->extension();
            $dir = "temp_images/";
            $photo->move($dir, $name.".".$file);
            $close10 = $name.".".$file;
        }
        $id = session('user_id');
        DB::table('n_exams')
            ->where('id',$req->exam_id)
            ->update([
                'ball' => $correct,
                'total' => $correct
            ]);

        DB::table('temp_answers')
            ->insert([
                'answer' => $req->close1,
                'photo' => $close1,
                'quiz_id' => $req->close_id1,
                'exam_id' => $req->exam_id,
                'user_id' => $id
            ]);
        DB::table('temp_answers')
            ->insert([
                'answer' => $req->close2,
                'photo' => $close2,
                'quiz_id' => $req->close_id2,
                'exam_id' => $req->exam_id,
                'user_id' => $id
            ]);
        DB::table('temp_answers')
            ->insert([
                'answer' => $req->close3,
                'photo' => $close3,
                'quiz_id' => $req->close_id3,
                'exam_id' => $req->exam_id,
                'user_id' => $id
            ]);
        DB::table('temp_answers')
            ->insert([
                'answer' => $req->close4,
                'photo' => $close4,
                'quiz_id' => $req->close_id4,
                'exam_id' => $req->exam_id,
                'user_id' => $id
            ]);
        DB::table('temp_answers')
            ->insert([
                'answer' => $req->close5,
                'photo' => $close5,
                'quiz_id' => $req->close_id5,
                'exam_id' => $req->exam_id,
                'user_id' => $id
            ]);
        DB::table('temp_answers')
            ->insert([
                'answer' => $req->close6,
                'photo' => $close6,
                'quiz_id' => $req->close_id6,
                'exam_id' => $req->exam_id,
                'user_id' => $id
            ]);
        DB::table('temp_answers')
            ->insert([
                'answer' => $req->close7,
                'photo' => $close7,
                'quiz_id' => $req->close_id7,
                'exam_id' => $req->exam_id,
                'user_id' => $id
            ]);
        DB::table('temp_answers')
            ->insert([
                'answer' => $req->close8,
                'photo' => $close8,
                'quiz_id' => $req->close_id8,
                'exam_id' => $req->exam_id,
                'user_id' => $id
            ]);
        DB::table('temp_answers')
            ->insert([
                'answer' => $req->close9,
                'photo' => $close9,
                'quiz_id' => $req->close_id9,
                'exam_id' => $req->exam_id,
                'user_id' => $id
            ]);
        DB::table('temp_answers')
            ->insert([
                'answer' => $req->close10,
                'photo' => $close10,
                'quiz_id' => $req->close_id10,
                'exam_id' => $req->exam_id,
                'user_id' => $id
            ]);        
        return view('user.result', ['correct' => $correct, 'count' => $correct_count]);
        }
    }

    public function select_block()
    {
        if(empty(session('full_name'))){
            return redirect(route('login'));
        }
        else{
            $price = DB::table('price')
                ->where('id',1)
                ->first();
            $amount = $price->price;
            $uns = DB::table('universities')
                ->get(['*']);
            return view('user.block.select', ['uni' => $uns,'price'=>$amount]);
        }
    }

    public function get_dir(Request $req)
    {
        if(empty(session('full_name'))){
            return redirect(route('login'));
        }
        else{
            $dirs = DB::table('directions')
                ->where('university_id', $req->otmID)
                ->where('lang', session('lang'))
                ->where('type', session('type'))
                ->get(['*']);
            return response()->json($dirs);
        }
    }

    public function set_dir(Request $req)
    {
        if(empty(session('full_name'))){
            return redirect(route('login'));
        }
        else{
            $dir = DB::table('directions')
                ->where('id', $req->dirID)
                ->first();
            $university = DB::table('universities')
            ->select('universities.name', 'universities.id')
            ->join('directions', 'universities.id', '=', 'directions.university_id')
            ->where('directions.first_subject_id', $dir->first_subject_id)
            ->where('directions.second_subject_id', $dir->second_subject_id)
            ->groupBy('universities.name', 'universities.id')
            ->get();
            session()->put('first_subject', $dir->first_subject_id);
            session()->put('second_subject', $dir->second_subject_id);
            return response()->json($university);
        }
    }

    public function dir(Request $req)
    {
        if(empty(session('full_name'))){
            return redirect(route('login'));
        }
        else{
            $dirs = DB::table('directions')
                ->where('university_id', $req->otmID)
                ->where('directions.first_subject_id', session('first_subject'))
                ->where('directions.second_subject_id', session('second_subject'))
                ->get(['*']);
            return response()->json($dirs);
        }
    }


    public function add_session(Request $req)
    {
        if(empty(session('full_name'))){
            return redirect(route('login'));
        }
        else{
            if (isset($req->lang)) {
                session()->put('lang', $req->lang);
            }
            elseif (isset($req->type)) {
                session()->put('type', $req->type);
            }
            $dirs = ['status' => 200];
            return response()->json($dirs);
        }
    }

    public function play_block(Request $req)
    {
        if(empty(session('full_name'))){
            return redirect(route('login'));
        }
        else{
            if(count($req->input()) != 13){
                return back()->with('error', '1');
            }
            else{
                $day = DB::table('exam_days')
                    ->latest()
                    ->first();
                $exam = DB::table('block_exam')
                    ->where('user_id', session('user_id'))
                    ->where('exam_day_id', $day->id)
                    ->first();
                if (empty($exam) or $day->date != date('Y-m-d')) {
                    return redirect(route('categories'));
                }
                $price = DB::table('price')
                    ->where('id',1)
                    ->first();
                $user = DB::table('users')
                    ->where('id', session('user_id'))
                    ->first();
                if ($price->price > $user->money) {
                    return back()->with('money_error','1');
                }
                $money = $user->money - $price->price;
                DB::table('users')
                    ->where('id', session('user_id'))
                    ->update([
                        'money' => $money
                    ]);
                session()->put('balans', $money);
                // return $req->input();
                $fi = DB::table('subjects')
                    ->where('id', session('first_subject'))
                    ->first();
                $s = DB::table('subjects')
                    ->where('id', session('second_subject'))
                    ->first();
                $dir1 = DB::table('directions')
                            ->where('id',$req->dir1)
                            ->first(); 
                $dir2 = DB::table('directions')
                            ->where('id',$req->dir2)
                            ->first(); 
                $dir3 = DB::table('directions')
                            ->where('id',$req->dir3)
                            ->first(); 
                $dir4 = DB::table('directions')
                            ->where('id',$req->dir4)
                            ->first(); 
                $dir5 = DB::table('directions')
                            ->where('id',$req->dir5)
                            ->first(); 
                $a1 = [];
                $a2 = [];
                $a3 = [];
                $a4 = [];
                $a5 = [];
                $first = DB::select(DB::raw("select * from compulsory_quizzes where `subject_id` = 4 ORDER BY RAND() LIMIT 10"));
                $second = DB::select(DB::raw("select * from compulsory_quizzes where `subject_id` = 5 ORDER BY RAND() LIMIT 10"));
                $third = DB::select(DB::raw("select * from compulsory_quizzes where `subject_id` = 7 ORDER BY RAND() LIMIT 10"));
                $four = DB::select(DB::raw("select * from quizzes where `subject_id` = {$fi->id} ORDER BY RAND() LIMIT 30"));
                $five = DB::select(DB::raw("select * from quizzes where `subject_id` = {$s->id} ORDER BY RAND() LIMIT 30"));
                foreach ($first as $value) {
                    $a1[] = DB::table('answers')
                        ->where('quiz_id', $value->id)
                        ->get(['*'])
                        ->shuffle();
                }
                foreach ($second as $value) {
                    $a2[] = DB::table('answers')
                        ->where('quiz_id', $value->id)
                        ->get(['*'])
                        ->shuffle();
                }
                foreach ($third as $value) {
                    $a3[] = DB::table('answers')
                        ->where('quiz_id', $value->id)
                        ->get(['*'])
                        ->shuffle();
                }
                foreach ($four as $value) {
                    $a4[] = DB::table('answers')
                        ->where('quiz_id', $value->id)
                        ->get(['*'])
                        ->shuffle();
                }
                foreach ($five as $value) {
                    $a5[] = DB::table('answers')
                        ->where('quiz_id', $value->id)
                        ->get(['*'])
                        ->shuffle();
                }
                DB::table('block_exam')
                    ->where('id', $exam->id)
                    ->update([
                        'lang' => $req->lang,
                        'type' => $req->type,
                        'compulsory_1' => 0,
                        'compulsory_2' => 0,
                        'compulsory_3' => 0,
                        'subject_1' => 0,
                        'subject_2' => 0,
                        's_name_1' => $fi->name,
                        's_name_2' => $s->name,
                        'dir1' => $dir1->uni_name."<br>".$dir1->name,
                        'ball1' => $dir1->grand,
                        'dir2' => $dir2->uni_name."<br>".$dir2->name,
                        'ball2' => $dir2->grand,
                        'dir3' => $dir3->uni_name."<br>".$dir3->name,
                        'ball3' => $dir3->grand,
                        'dir4' => $dir4->uni_name."<br>".$dir4->name,
                        'ball4' => $dir4->grand,
                        'dir5' => $dir5->uni_name."<br>".$dir5->name,
                        'ball5' => $dir5->grand,
                        'kontrakt1' => $dir1->kontrakt,
                        'kontrakt2' => $dir2->kontrakt,
                        'kontrakt3' => $dir3->kontrakt,
                        'kontrakt4' => $dir4->kontrakt,
                        'kontrakt5' => $dir5->kontrakt,
                        'total' => 0
                    ]);
                $f_name = $fi->name;
                $s_name = $s->name;
                return view('user.block.test', ['name1'=>$f_name, 'name2'=>$s_name,'a1'=>$a1,'a2'=>$a2,'a3'=>$a3,'a4'=>$a4,'a5'=>$a5,'exam'=>$exam,'first' => $first,'second' => $second,'third' => $third,'four' => $four,'five' => $five]);
            }
        }
    }


    public function check_block(Request $req)
    {
        if(empty(session('full_name'))){
            return redirect(route('login'));
        }
        else{
            // return $req->input();
            $a1 = 0;
            $a2 = 0;
            $a3 = 0;
            $a4 = 0;
            $a5 = 0;
            for ($i=1; $i <= 10; $i++) { 
                $i = "four".$i; 
                if (isset($req->$i)) {
                    $answer = DB::table('answers')
                        ->where('id',$req->$i)
                        ->first();
                    if ($answer->correct == 1) {
                        $a1 = $a1 + 1.1;
                    }
                }
            }
            for ($i=11; $i <= 20; $i++) { 
                $i = "four".$i; 
                if (isset($req->$i)) {
                    $answer = DB::table('answers')
                        ->where('id',$req->$i)
                        ->first();
                    if ($answer->correct == 1) {
                        $a2 = $a2 + 1.1;
                    }
                }
            }
            for ($i=21; $i <= 30; $i++) { 
                $i = "four".$i; 
                if (isset($req->$i)) {
                    $answer = DB::table('answers')
                        ->where('id',$req->$i)
                        ->first();
                    if ($answer->correct == 1) {
                        $a3 = $a3 + 1.1;
                    }
                }
            }
            for ($i=31; $i <= 60; $i++) { 
                $i = "four".$i; 
                if (isset($req->$i)) {
                    $answer = DB::table('answers')
                        ->where('id',$req->$i)
                        ->first();
                    if ($answer->correct == 1) {
                        $a4 = $a4 + 3.1;
                    }
                }
            }
            for ($i=61; $i <= 90; $i++) { 
                $i = "four".$i; 
                if (isset($req->$i)) {
                    $answer = DB::table('answers')
                        ->where('id',$req->$i)
                        ->first();
                    if ($answer->correct == 1) {
                        $a5 = $a5 + 3.2;
                    }
                }
            }
            $total = $a1+$a2+$a3+$a4+$a5;
            $exam =  DB::table('block_exam')
                ->where('id', $req->exam_id)
                ->first();
            if ($exam->ball1 <= $total) {
                $bir = "Grand";
            }
            elseif($exam->kontrakt1 <= $total){
                $bir = "Kontrakt";
            }
            else {
                $bir = "Ilinmadi";
            }

            if ($exam->ball2 <= $total) {
                $ikki = "Grand";
            }
            elseif($exam->kontrakt2 <= $total){
                $ikki = "Kontrakt";
            }
            else {
                $ikki = "Ilinmadi";
            }

            if ($exam->ball3 <= $total) {
                $uch = "Grand";
            }
            elseif($exam->kontrakt3 <= $total){
                $uch = "Kontrakt";
            }
            else {
                $uch = "Ilinmadi";
            }

            if ($exam->ball4 <= $total) {
                $tort = "Grand";
            }
            elseif($exam->kontrakt4 <= $total){
                $tort = "Kontrakt";
            }
            else {
                $tort = "Ilinmadi";
            }

            if ($exam->ball5 <= $total) {
                $besh = "Grand";
            }
            elseif($exam->kontrakt5 <= $total){
                $besh = "Kontrakt";
            }
            else {
                $besh = "Ilinmadi";
            }

        
            DB::table('block_exam')
                ->where('id', $req->exam_id)
                ->update([
                    'compulsory_1' => $a1,
                    'compulsory_2' => $a2,
                    'compulsory_3' => $a3,
                    'subject_1' => $a4,
                    'subject_2' => $a5,
                    'total' => $total,
                    'status' => 1
                ]);
            // return ['bir'=>$bir,'ikki'=>$ikki,'uch'=>$uch,'tort'=>$tort,'besh'=>$besh,'a1'=>$a1,'a2'=>$a2,'a3'=>$a3,'a4'=>$a4,'a5'=>$a5,'exam' => $exam];
            return view('user.block.result', ['bir'=>$bir,'ikki'=>$ikki,'uch'=>$uch,'tort'=>$tort,'besh'=>$besh,'a1'=>$a1,'a2'=>$a2,'a3'=>$a3,'a4'=>$a4,'a5'=>$a5,'exam' => $exam]);
            
        }
    }
}
