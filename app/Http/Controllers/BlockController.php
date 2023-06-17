<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlockController extends Controller
{
    public function exam_days(){
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $exam_days = DB::table('exam_days')
                ->latest()
                ->get(['*']);
            return view('admin.block.exam_days',['exam_days'=>$exam_days,'compulsory' => $compulsory,'all_subject'=>$all_subject]);
        }
        else{
            return abort(404);
        }
    }

    public function new_exam_day(Request $req){
        if (session('admin') == "1"){
            $exam = DB::table('exam_days')
                ->latest()
                ->first();
            $now = date("Y-m-d");
            if (strtotime($exam->date) < strtotime('now')) {
                DB::table('exam_days')
                    ->insert([
                        'date'=>$req->date
                    ]);
                return redirect(route('b_exam_days'));
            }
            elseif(strtotime($req->date) < strtotime('now')){
                session()->flash('error_date',"1");
                return redirect(route('b_exam_days'));
            }
            else{
                session()->flash('error_date1',"1");
                return redirect(route('b_exam_days'));
            }
        }
        else{
            return abort(404);
        }
    }


    public function sale()
    {
        if(empty(session('full_name'))){
            return redirect(route('login'));
        }
        else {
            $day = DB::table('exam_days')
                ->latest()
                ->first();
            $exam = DB::table('block_exam')
                ->where('user_id', session('user_id'))
                ->where('exam_day_id', $day->id)
                ->first();
            if (!empty($exam)) {
                return redirect(route('categories'));
            }
            else {
                $price = DB::table('price')
                    ->where('id',1)
                    ->first();
                $user = DB::table('users')
                    ->where('id', session('user_id'))
                    ->first();
                if ($price->price > $user->money) {
                    return redirect(route('Payment'));
                }
                else {
                    $money = $user->money - $price->price;
                    DB::table('users')
                        ->where('id', session('user_id'))
                        ->update([
                            'money' => $money
                        ]);
                    session()->put('balans', $money);
                }
                DB::table('block_exam')
                    ->insert([
                        'user_id' => session('user_id'),
                        'exam_day_id' => $day->id,
                        'date' => $day->date
                    ]);
                
                return redirect(route('categories'));
            }
        }
    }




















    public function all_subject(){
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $subjects = DB::table('national_exam')
                ->latest()
                ->get(['*']);
            return view('admin.national.all_exams',['compulsory' => $compulsory,'all_subject'=>$all_subject,'subjects'=>$subjects]);
        }
        else{
            return abort(404);
        }
    }

    public function edit($id){
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $subject = DB::table('national_exam')
                ->where('id',$id)
                ->first();
            return view('admin.national.editForm',['compulsory' => $compulsory,'all_subject'=>$all_subject,'subject'=>$subject]);
        }
        else{
            return abort(404);
        }
    }

    public function new_subject(Request $req){
        if (session('admin') == "1"){
            DB::table('national_exam')
                ->insert([
                    'name'=>$req->name,
                    'price'=>$req->price
                ]);
            return redirect(route('all_exam'));
        }
        else{
            return abort(404);
        }
    }

    public function national_delete(Request $req){
        if (session('admin') == "1"){
            DB::table('national_exam')
                ->delete($req->id);
            return redirect(route('all_exam'));
        }
        else{
            return abort(404);
        }
    }

    public function n_quiz_delete(Request $req){
        if (session('admin') == "1"){
            $quiz = DB::table('n_quizzes')
                ->where('id',$req->id)
                ->first();
            if ($quiz->photo != "no_photo"){
                unlink('quiz_images/'.$quiz->photo);
            }
            $answers = DB::table('n_answers')
                ->where('quiz_id',$quiz->id)
                ->get(['*']);
            foreach ($answers as $item){
                if ($item->photo != "no_photo"){
                    unlink('answer_images/'.$item->photo);
                }
                DB::table('n_answers')
                    ->delete($item->id);
            }
            DB::table('n_quizzes')
                ->delete($quiz->id);
            return redirect(route('national_view',['id' => $req->subject_id]));
        }
        else{
            return abort(404);
        }
    }

    public function national_update(Request $req){
        if (session('admin') == "1"){
            DB::table('national_exam')
                ->where('id',$req->id)
                ->update([
                    'name'=>$req->name,
                    'price'=>$req->price
                ]);
            return redirect(route('all_exam'));
        }
        else{
            return abort(404);
        }
    }

    public function national_view($id){
        if (session('admin') == "1"){
            $quizzes = DB::table('n_quizzes')
                ->where('exam_id',$id)
                ->get(['*']);
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $exam = DB::table('national_exam')
                ->where('id',$id)
                ->first();
            return view('admin.national.viewQuizzes',['exam'=>$exam,'compulsory' => $compulsory,'all_subject'=>$all_subject,'quizzes'=>$quizzes]);
        }
        else{
            return abort(404);
        }
    }

    public function new_n_quiz($id,$type){
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            return view('admin.national.newQuiz',['id'=>$id,'type'=>$type,'compulsory' => $compulsory,'all_subject'=>$all_subject]);
        }
        else{
            return abort(404);
        }
    }

    public function new_n_quiz_reg(Request $req){
        if (session('admin') == "1"){
            // return $req;
            if ($req->type == 'two') {
                $quiz_photo = "no_photo";
                if ($req->hasFile('quiz_photo')){
                    $photo = $req->file('quiz_photo');
                    $name = md5(microtime());
                    $file = $req->file('quiz_photo')->extension();
                    $dir = "quiz_images/";
                    $photo->move($dir, $name.".".$file);
                    $quiz_photo = $name.".".$file;
                }
                DB::table('n_quizzes')
                    ->insert([
                        'quiz' => $req->quiz,
                        'exam_id' => $req->id,
                        'photo' => $quiz_photo,
                        'type' => $req->type,
                        'ball' => $req->ball,
                        'ball2' => $req->ball2
                    ]);
                $quiz_id = DB::table('n_quizzes')
                    ->latest()
                    ->first();
                DB::table('n_answers')
                    ->insert([
                        'answer' => $req->a_answer,
                        'correct' => 1,
                        'quiz_id' => $quiz_id->id
                    ]);
                DB::table('n_answers')
                    ->insert([
                        'answer' => $req->b_answer,
                        'correct' => 1,
                        'quiz_id' => $quiz_id->id
                    ]);
            }
            elseif ($req->type == 'close'){
                $quiz_photo = "no_photo";
                if ($req->hasFile('quiz_photo')){
                    $photo = $req->file('quiz_photo');
                    $name = md5(microtime());
                    $file = $req->file('quiz_photo')->extension();
                    $dir = "quiz_images/";
                    $photo->move($dir, $name.".".$file);
                    $quiz_photo = $name.".".$file;
                }
                DB::table('n_quizzes')
                    ->insert([
                        'quiz' => $req->quiz,
                        'exam_id' => $req->id,
                        'photo' => $quiz_photo,
                        'type' => $req->type,
                        'ball' => $req->ball
                    ]);
                $quiz_id = DB::table('n_quizzes')
                    ->latest()
                    ->first();
                DB::table('n_answers')
                    ->insert([
                        'answer' => $req->a_answer,
                        'correct' => 1,
                        'quiz_id' => $quiz_id->id
                    ]);
            }
            elseif ($req->type == 'six'){
                $quiz_photo = "no_photo";
                $a_photo = "no_photo";
                $b_photo = "no_photo";
                $c_photo = "no_photo";
                $d_photo = "no_photo";
                $e_photo = "no_photo";
                $f_photo = "no_photo";
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
                if ($req->hasFile('e_photo')){
                    $photo = $req->file('e_photo');
                    $name = md5(microtime());
                    $file = $req->file('e_photo')->extension();
                    $dir = "answer_images/";
                    $photo->move($dir, $name.".".$file);
                    $e_photo = $name.".".$file;
                }
                if ($req->hasFile('f_photo')){
                    $photo = $req->file('f_photo');
                    $name = md5(microtime());
                    $file = $req->file('f_photo')->extension();
                    $dir = "answer_images/";
                    $photo->move($dir, $name.".".$file);
                    $f_photo = $name.".".$file;
                }
                DB::table('n_quizzes')
                    ->insert([
                        'quiz' => $req->quiz,
                        'exam_id' => $req->id,
                        'photo' => $quiz_photo,
                        'type' => $req->type,
                        'ball' => $req->ball
                    ]);
                $quiz_id = DB::table('n_quizzes')
                    ->latest()
                    ->first();
                $a_correct = 0;
                $b_correct = 0;
                $c_correct = 0;
                $d_correct = 0;
                $e_correct = 0;
                $f_correct = 0;
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
                    case "E":
                        $e_correct = 1;
                        break;
                    case "F":
                        $f_correct = 1;
                        break;
                }
                DB::table('n_answers')
                    ->insert([
                        'answer' => $req->a_answer,
                        'correct' => $a_correct,
                        'quiz_id' => $quiz_id->id,
                        'photo' => $a_photo,
                        'ball' => $quiz_id->ball
                    ]);
                DB::table('n_answers')
                    ->insert([
                        'answer' => $req->b_answer,
                        'correct' => $b_correct,
                        'quiz_id' => $quiz_id->id,
                        'photo' => $b_photo,
                        'ball' => $quiz_id->ball
                    ]);
                DB::table('n_answers')
                    ->insert([
                        'answer' => $req->c_answer,
                        'correct' => $c_correct,
                        'quiz_id' => $quiz_id->id,
                        'photo' => $c_photo,
                        'ball' => $quiz_id->ball
                    ]);
                DB::table('n_answers')
                    ->insert([
                        'answer' => $req->d_answer,
                        'correct' => $d_correct,
                        'quiz_id' => $quiz_id->id,
                        'photo' => $d_photo,
                        'ball' => $quiz_id->ball
                    ]);
                DB::table('n_answers')
                    ->insert([
                        'answer' => $req->e_answer,
                        'correct' => $e_correct,
                        'quiz_id' => $quiz_id->id,
                        'photo' => $e_photo,
                        'ball' => $quiz_id->ball
                    ]);
                DB::table('n_answers')
                    ->insert([
                        'answer' => $req->f_answer,
                        'correct' => $f_correct,
                        'quiz_id' => $quiz_id->id,
                        'photo' => $f_photo,
                        'ball' => $quiz_id->ball
                    ]);
                return redirect(route('national_view',['id' => $req->id]));
            }
            else{
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
                DB::table('n_quizzes')
                    ->insert([
                        'quiz' => $req->quiz,
                        'exam_id' => $req->id,
                        'photo' => $quiz_photo,
                        'type' => $req->type,
                        'ball' => $req->ball
                    ]);
                $quiz_id = DB::table('n_quizzes')
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
                DB::table('n_answers')
                    ->insert([
                        'answer' => $req->a_answer,
                        'correct' => $a_correct,
                        'quiz_id' => $quiz_id->id,
                        'photo' => $a_photo,
                        'ball' => $quiz_id->ball
                    ]);
                DB::table('n_answers')
                    ->insert([
                        'answer' => $req->b_answer,
                        'correct' => $b_correct,
                        'quiz_id' => $quiz_id->id,
                        'photo' => $b_photo,
                        'ball' => $quiz_id->ball
                    ]);
                DB::table('n_answers')
                    ->insert([
                        'answer' => $req->c_answer,
                        'correct' => $c_correct,
                        'quiz_id' => $quiz_id->id,
                        'photo' => $c_photo,
                        'ball' => $quiz_id->ball
                    ]);
                DB::table('n_answers')
                    ->insert([
                        'answer' => $req->d_answer,
                        'correct' => $d_correct,
                        'quiz_id' => $quiz_id->id,
                        'photo' => $d_photo,
                        'ball' => $quiz_id->ball
                    ]);
            }
            return redirect(route('national_view',['id' => $req->id]));
        }
        else{
            return abort(404);
        }
    }

    public function n_quiz_view($id){
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $quiz = DB::table('n_quizzes')
                ->where('id',$id)
                ->first();
            $answers = DB::table('n_answers')
                ->where('quiz_id', $quiz->id)
                ->get(['*']);
            return view('admin.national.viewQuiz',['quiz'=>$quiz,'answers'=>$answers,'compulsory' => $compulsory,'all_subject'=>$all_subject]);
        }
        else{
            return abort(404);
        }
    }

    


    public function n_quiz_edit($id){
        if (session('admin') == "1"){
            $quiz = DB::table('n_quizzes')
                ->where('id',$id)
                ->first();
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $answers = DB::table('n_answers')
                ->where('quiz_id',$quiz->id)
                ->get(['*']);
            return view('admin.national.editQuiz',['quiz'=>$quiz,'answers'=>$answers,'compulsory' => $compulsory,'all_subject'=>$all_subject]);
        }
        else{
            return abort(404);
        }
    }

    // Milliy sertifikat testini update qiladi
    public function n_quiz_update(Request $req){
        if (session('admin') == "1"){
            $quiz = DB::table('n_quizzes')
                ->where('id',$req->quiz_id)
                ->first();
            $quiz_photo = $quiz->photo;
            if ($req->hasFile('quiz_photo')){
                if ($quiz->photo != "no_photo"){
                    unlink('quiz_images/'.$quiz->photo);
                }
                $photo = $req->file('quiz_photo');
                $name = md5(microtime());
                $file = $req->file('quiz_photo')->extension();
                $dir = "quiz_images/";
                $photo->move($dir, $name.".".$file);
                $quiz_photo = $name.".".$file;
            }
            DB::table('n_quizzes')
                ->where('id', $quiz->id)
                ->update([
                    'quiz' => $req->quiz_text,
                    'photo' => $quiz_photo,
                    'ball' => $req->ball
                ]);
            if ($quiz->type != "close") {
                $answer_a = DB::table('n_answers')
                    ->where('id',$req->answer_id0)
                    ->first();
                $answer_a_photo = $answer_a->photo;
                if ($req->hasFile('answer_photo0')){
                    if ($answer_a->photo != "no_photo"){
                        unlink('answer_images/'.$answer_a->photo);
                    }
                    $photo = $req->file('answer_photo0');
                    $name = md5(microtime());
                    $file = $req->file('answer_photo0')->extension();
                    $dir = "answer_images/";
                    $photo->move($dir, $name.".".$file);
                    $answer_a_photo = $name.".".$file;
                }
                DB::table('n_answers')
                    ->where('id',$answer_a->id)
                    ->update([
                        'answer' => $req->answer0,
                        'photo' => $answer_a_photo,
                        'ball' => $req->ball
                    ]);


                $answer_b = DB::table('n_answers')
                    ->where('id',$req->answer_id1)
                    ->first();
                $answer_b_photo = $answer_b->photo;
                if ($req->hasFile('answer_photo1')){
                    if ($answer_b->photo != "no_photo"){
                        unlink('answer_images/'.$answer_b->photo);
                    }
                    $photo = $req->file('answer_photo1');
                    $name = md5(microtime());
                    $file = $req->file('answer_photo1')->extension();
                    $dir = "answer_images/";
                    $photo->move($dir, $name.".".$file);
                    $answer_b_photo = $name.".".$file;
                }
                DB::table('n_answers')
                    ->where('id',$answer_b->id)
                    ->update([
                        'answer' => $req->answer1,
                        'photo' => $answer_b_photo,
                        'ball' => $req->ball
                    ]);

                $answer_c = DB::table('n_answers')
                    ->where('id',$req->answer_id2)
                    ->first();
                $answer_c_photo = $answer_c->photo;
                if ($req->hasFile('answer_photo2')){
                    if ($answer_c->photo != "no_photo"){
                        unlink('answer_images/'.$answer_c->photo);
                    }
                    $photo = $req->file('answer_photo2');
                    $name = md5(microtime());
                    $file = $req->file('answer_photo2')->extension();
                    $dir = "answer_images/";
                    $photo->move($dir, $name.".".$file);
                    $answer_c_photo = $name.".".$file;
                }
                DB::table('n_answers')
                    ->where('id',$answer_c->id)
                    ->update([
                        'answer' => $req->answer2,
                        'photo' => $answer_c_photo,
                        'ball' => $req->ball
                    ]);

                
                $answer_d = DB::table('n_answers')
                    ->where('id',$req->answer_id3)
                    ->first();
                $answer_d_photo = $answer_d->photo;
                if ($req->hasFile('answer_photo3')){
                    if ($answer_d->photo != "no_photo"){
                        unlink('answer_images/'.$answer_d->photo);
                    }
                    $photo = $req->file('answer_photo3');
                    $name = md5(microtime());
                    $file = $req->file('answer_photo3')->extension();
                    $dir = "answer_images/";
                    $photo->move($dir, $name.".".$file);
                    $answer_d_photo = $name.".".$file;
                }
                DB::table('n_answers')
                    ->where('id',$answer_d->id)
                    ->update([
                        'answer' => $req->answer3,
                        'photo' => $answer_d_photo,
                        'ball' => $req->ball
                    ]);
                if($quiz->type == "six"){
                    $answer_e = DB::table('n_answers')
                        ->where('id',$req->answer_id4)
                        ->first();
                    $answer_e_photo = $answer_e->photo;
                    if ($req->hasFile('answer_photo4')){
                        if ($answer_e->photo != "no_photo"){
                            unlink('answer_images/'.$answer_e->photo);
                        }
                        $photo = $req->file('answer_photo4');
                        $name = md5(microtime());
                        $file = $req->file('answer_photo4')->extension();
                        $dir = "answer_images/";
                        $photo->move($dir, $name.".".$file);
                        $answer_e_photo = $name.".".$file;
                    }
                    DB::table('n_answers')
                        ->where('id',$answer_e->id)
                        ->update([
                            'answer' => $req->answer4,
                            'photo' => $answer_e_photo,
                            'ball' => $req->ball
                        ]);


                    $answer_f = DB::table('n_answers')
                        ->where('id',$req->answer_id5)
                        ->first();
                    $answer_f_photo = $answer_f->photo;
                    if ($req->hasFile('answer_photo5')){
                        if ($answer_f->photo != "no_photo"){
                            unlink('answer_images/'.$answer_f->photo);
                        }
                        $photo = $req->file('answer_photo5');
                        $name = md5(microtime());
                        $file = $req->file('answer_photo5')->extension();
                        $dir = "answer_images/";
                        $photo->move($dir, $name.".".$file);
                        $answer_f_photo = $name.".".$file;
                    }
                    DB::table('n_answers')
                        ->where('id',$answer_f->id)
                        ->update([
                            'answer' => $req->answer5,
                            'photo' => $answer_f_photo,
                            'ball' => $req->ball
                        ]);
                }
            }
            return redirect(route('national_view', ['id' => $quiz->exam_id]));            
        }
        else{
            return abort(404);
        }
    }

    public function n_results(){
        if (session('admin') == "1"){
            $exam_days = DB::table('exam_days')
                ->get(['*']);
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $exams = DB::table('n_exams')
                ->where('check_ball',0)
                ->latest()
                ->get(['*']);
            return view('admin.national.results',['exam_days'=> $exam_days,'exams'=>$exams,'compulsory' => $compulsory,'all_subject'=>$all_subject]);
        }
        else{
            return abort(404);
        }
    }

    public function admin_check($exam_id){
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $answers = DB::table('temp_answers')
                ->where('exam_id',$exam_id)
                ->get(['*']);
            $quizzes = [];
            foreach ($answers as $value) {
                $quizzes[] = DB::table('n_quizzes')
                    ->where('id',$value->quiz_id)
                    ->first();
            }
            return view('admin.national.admin_check',['exam_id'=> $exam_id,'answers'=>$answers,'quizzes'=>$quizzes,'compulsory' => $compulsory,'all_subject'=>$all_subject]);
            // return $quizzes;
        }
        else{
            return abort(404);
        }
    }

    public function n_checked(Request $req){
        if (session('admin') == "1"){
            $ball = 0;
            for ($i=0; $i < 21; $i++) { 
                $f = "answer".$i;
                if(isset($req[$f])){
                    $ball = $ball + $req[$f];
                }
            }
            $answers = DB::table('temp_answers')
                ->where('exam_id',$req->exam_id)
                ->get(['*']);
            foreach ($answers as $value) {
                if ($value->photo != "no_photo") {
                    unlink('temp_images/'.$value->photo);
                }
                DB::table('temp_answers')
                    ->where('id',$value->id)
                    ->delete();
            }
            $exam = DB::table('n_exams')
                ->where('id',$req->exam_id)
                ->first();
            $total = $exam->ball + $ball;
            DB::table('n_exams')
                ->where('id',$req->exam_id)
                ->update([
                    'total'=>$total,
                    'check_ball'=>$ball,
                    'is_check'=>1
                ]);
            return redirect(route('n_results'));
        }
        else{
            return abort(404);
        }
    }

    public function edit_exam_day_reg(Request $req){
        if (session('admin') == "1"){
            $exam_day = DB::table('n_exam_days')
                ->where('id', $req->day_id)
                ->first();
            if ($exam_day->date > $req->date) {
                session()->flash("error_date", "1");
                $compulsory = DB::table('compulsory_subjects')
                    ->get(['*']);
                $all_subject = DB::table('subjects')
                    ->get(['*']);
                return view('admin.national.exam_day_edit',['compulsory' => $compulsory,'all_subject'=>$all_subject,'exam_day'=>$exam_day]);
            }
            else{
                DB::table('n_exams')
                    ->where('exam_day_id', $exam_day->id)
                    ->update([
                        'date' => $req->date
                    ]);
                DB::table('n_exam_days')
                    ->where('id', $req->day_id)
                    ->update([
                        'date' => $req->date
                    ]);
                return redirect(route('exam_days'));
            }
        }
        else{
            return abort(404);
        }
    }

    public function edit_exam_day($id){
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $exam_day = DB::table('n_exam_days')
                ->where('id',$id)
                ->first();
            return view('admin.national.exam_day_edit',['compulsory' => $compulsory,'all_subject'=>$all_subject,'exam_day'=>$exam_day]);
        }
        else{
            return abort(404);
        }
    }
}
