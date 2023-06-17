<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
//    Adminni tekshirish
    public function admin_check(Request $req)
    {
        $user = DB::table('admins')
            ->where('email', $req->email)
            ->first();
        if (!empty($user) and ($user->password == md5(md5($req->password)))){
            session()->put("admin", "1");
            return redirect(route('admin-home'));
        }
        else{
            session()->flash('login_error','1');
            return Redirect::back();
        }
    }

    // public function uni_name()
    // {
    //     $dirs = DB::table('directions')
    //         ->get(['*']);
    //     foreach ($dirs as $value) {
    //         $uni = DB::table('universities')
    //             ->where('id', $value->university_id)
    //             ->first();
    //         DB::table('directions')
    //             ->where('id',$value->id)
    //             ->update([
    //                 'uni_name' => $uni->name
    //             ]);
    //     }
    //     return $dirs;
    // }

//    Admin uchun bosh sahifani qaytaradi
    public function admin_home()
    {
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            return view('admin.index',['compulsory' => $compulsory,'all_subject'=>$all_subject,'all_subject'=>$all_subject]);
        }
        else{
            return abort(404);
        }
    }

//    Yangi majburiy fan uchun forma yuboradi
    public function new_compulsory()
    {
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            return view('admin.new_compulsory',['compulsory' => $compulsory,'all_subject'=>$all_subject]);
        }
        else{
            return abort(404);
        }
    }

//    Yangi majburiy fanni registratsiya qiladi
    public function new_compulsory_reg(Request $req)
    {
        if (session('admin') == "1"){
            DB::table('compulsory_subjects')
                ->insert([
                    'name' => $req->name,
                    'lang' => $req->lang
                ]);
            $quiz_category = DB::table('compulsory_subjects')
                ->latest()
                ->first();
            return redirect(route('view_subject_compulsory',['id' => $quiz_category->id]));
        }
        else{
            return abort(404);
        }
    }

//    Majburiy fanni savollarini ko'radi
    public function view_subject_compulsory($id)
    {
        if (session('admin') == "1"){
            $quizzes = DB::table('compulsory_quizzes')
                ->where('subject_id',$id)
                ->get(['*']);
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $subject = DB::table('compulsory_subjects')
                ->where('id',$id)
                ->first();
            session()->flash('name',$subject->name);
            $subject_id = $subject->id;
            return view('admin.view_subject_compulsory',['compulsory' => $compulsory,'all_subject'=>$all_subject, 'quizzes'=>$quizzes,'subject_id'=>$subject_id]);
        }
        else{
            return abort(404);
        }
    }

//    Majburiy fan savoli uchun forma jo'natadi
    public function new_compulsory_quiz($subject_id)
    {
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            return view('admin.new_compulsory_quiz',['compulsory' => $compulsory,'all_subject'=>$all_subject,'subject_id'=>$subject_id]);
        }
        else{
            return abort(404);
        }
    }

//    Majburiy fan savolini ro'yhatga qo'shadi
    public function new_compulsory_quiz_reg(Request $req)
    {
        if (session('admin') == "1"){
            $quiz_photo = "no_photo";
            $a_photo = "no_photo";
            $b_photo = "no_photo";
            $c_photo = "no_photo";
            $d_photo = "no_photo";
            if ($req->hasFile('quiz_photo')){
                $photo = $req->file('quiz_photo');
                $name = md5(microtime());
                $file = $req->file('quiz_photo')->extension();
                $dir = "quiz_images/";
                $photo->move($dir, $name.".".$file);
                $quiz_photo = $name.".".$file;
            }
            if ($req->hasFile('a_photo')){
                $photo = $req->file('a_photo');
                $name = md5(microtime());
                $file = $req->file('a_photo')->extension();
                $dir = "answer_images/";
                $photo->move($dir, $name.".".$file);
                $a_photo = $name.".".$file;
            }
            if ($req->hasFile('b_photo')){
                $photo = $req->file('b_photo');
                $name = md5(microtime());
                $file = $req->file('b_photo')->extension();
                $dir = "answer_images/";
                $photo->move($dir, $name.".".$file);
                $b_photo = $name.".".$file;
            }
            if ($req->hasFile('c_photo')){
                $photo = $req->file('c_photo');
                $name = md5(microtime());
                $file = $req->file('c_photo')->extension();
                $dir = "answer_images/";
                $photo->move($dir, $name.".".$file);
                $c_photo = $name.".".$file;
            }
            if ($req->hasFile('d_photo')){
                $photo = $req->file('d_photo');
                $name = md5(microtime());
                $file = $req->file('d_photo')->extension();
                $dir = "answer_images/";
                $photo->move($dir, $name.".".$file);
                $d_photo = $name.".".$file;
            }
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            DB::table('compulsory_quizzes')
                ->insert([
                    'quiz' => $req->quiz,
                    'subject_id' => $req->subject_id,
                    'photo' => $quiz_photo
                ]);
            $quiz_id = DB::table('compulsory_quizzes')
                ->latest()
                ->first();
            $a_correct = 0;
            $b_correct = 0;
            $c_correct = 0;
            $d_correct = 0;
            switch ($req->correct){
                case "A":
                    $a_correct = 1;
                    break;
                case "B":
                    $b_correct = 1;
                    break;
                case "C":
                    $c_correct = 1;
                    break;
                case "D":
                    $d_correct = 1;
                    break;
            }
            DB::table('compulsory_answers')
                ->insert([
                    'answer' => $req->a_answer,
                    'correct' => $a_correct,
                    'quiz_id' => $quiz_id->id,
                    'photo' => $a_photo
                ]);
            DB::table('compulsory_answers')
                ->insert([
                    'answer' => $req->b_answer,
                    'correct' => $b_correct,
                    'quiz_id' => $quiz_id->id,
                    'photo' => $b_photo
                ]);
            DB::table('compulsory_answers')
                ->insert([
                    'answer' => $req->c_answer,
                    'correct' => $c_correct,
                    'quiz_id' => $quiz_id->id,
                    'photo' => $c_photo
                ]);
            DB::table('compulsory_answers')
                ->insert([
                    'answer' => $req->d_answer,
                    'correct' => $d_correct,
                    'quiz_id' => $quiz_id->id,
                    'photo' => $d_photo
                ]);
            return redirect(route('view_subject_compulsory',['id' => $req->subject_id]));
        }
        else{
            return abort(404);
        }
    }

//    Majburiy fan savolini o'chiradi
    public function compulsory_delete(Request $req)
    {
        if (session('admin') == "1"){
            $quiz = DB::table('compulsory_quizzes')
                ->where('id',$req->id)
                ->first();
            if ($quiz->photo != "no_photo"){
                unlink('quiz_images/'.$quiz->photo);
            }
            $answers = DB::table('compulsory_answers')
                ->where('quiz_id',$quiz->id)
                ->get(['*']);
            foreach ($answers as $item){
                if ($item->photo != "no_photo"){
                    unlink('answer_images/'.$item->photo);
                }
                DB::table('compulsory_answers')
                    ->delete($item->id);
            }
            DB::table('compulsory_quizzes')
                ->delete($quiz->id);
            return redirect(route('view_subject_compulsory',['id' => $req->subject_id]));
        }
        else{
            return abort(404);
        }
    }

    //    Majburiy fan savolini ko'rish
    public function compulsory_view($id)
    {
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $quiz = DB::table('compulsory_quizzes')
                ->where('id',$id)
                ->first();
            $answers = DB::table('compulsory_answers')
                ->where('quiz_id',$id)
                ->get(['*']);
            return view('admin.compulsory_quiz',['compulsory' => $compulsory,'all_subject'=>$all_subject,'quiz'=>$quiz,'answers'=>$answers]);
        }
        else{
            return abort(404);
        }
    }

    // Userlarni ko'rish
    public function users()
    {
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $users = DB::table('users')
                ->paginate(100);
            return view('admin.users',['compulsory' => $compulsory,'all_subject'=>$all_subject,'users'=>$users]);
        }
        else{
            return abort(404);
        }
    }

    // Update money
    public function update_money(Request $req)
    {
        if (session('admin') == "1"){
            $users = DB::table('users')
                ->where('id',$req->user_id)
                ->update([
                    'money' => $req->amount
                ]);
            return redirect()->back();
        }
        else{
            return abort(404);
        }
    }


    // View block pricies
    public function pricies()
    {
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $price = DB::table('price')
                ->where('id',1)
                ->first();
            // dd($price);
            return view('admin.price',['compulsory' => $compulsory,'all_subject'=>$all_subject,'price'=>$price]);
        }
        else{
            return abort(404);
        }
    }

    // Update price
    public function update_price(Request $req)
    {
        if (session('admin') == "1"){
            DB::table('price')
                ->where('id',$req->id)
                ->update([
                    'price' => $req->amount
                ]);
            return redirect()->back();
        }
        else{
            return abort(404);
        }
    }
}
