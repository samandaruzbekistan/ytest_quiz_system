<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function new_subject()
    {
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            return view('admin.new_subject',['compulsory' => $compulsory,'all_subject'=>$all_subject]);
        }
        else{
            return abort(404);
        }
    }

    //    Yangi fanni registratsiya qiladi
    public function new_subject_reg(Request $req)
    {
        if (session('admin') == "1"){
            DB::table('subjects')
                ->insert([
                    'name' => $req->name,
                    'lang' => $req->lang
                ]);
            $quiz_category = DB::table('subjects')
                ->latest()
                ->first();
            return redirect(route('view_subject',['id' => $quiz_category->id]));
        }
        else{
            return abort(404);
        }
    }

    //   fanni savollarini ko'radi
    public function view_subject($id)
    {
        if (session('admin') == "1"){
            $subject = DB::table('subjects')
                ->where('id',$id)
                ->first();
            $quizzes = DB::table('quizzes')
                ->where('subject_id',$id)
                ->get(['*']);
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);

            session()->flash('name',$subject->name);
            $subject_id = $subject->id;
            return view('admin.view_subject',['compulsory' => $compulsory,'all_subject'=>$all_subject, 'quizzes'=>$quizzes,'subject_id'=>$subject_id]);
        }
        else{
            return abort(404);
        }
    }

    //    Fan savoli uchun forma jo'natadi
    public function new_subject_quiz($subject_id)
    {
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            return view('admin.new_subject_quiz',['compulsory' => $compulsory,'all_subject'=>$all_subject,'subject_id'=>$subject_id]);
        }
        else{
            return abort(404);
        }
    }

    //    Fan savolini ro'yhatga qo'shadi
    public function new_subject_quiz_reg(Request $req)
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
            DB::table('quizzes')
                ->insert([
                    'quiz' => $req->quiz,
                    'subject_id' => $req->subject_id,
                    'photo' => $quiz_photo
                ]);
            $quiz_id = DB::table('quizzes')
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
            DB::table('answers')
                ->insert([
                    'answer' => $req->a_answer,
                    'correct' => $a_correct,
                    'quiz_id' => $quiz_id->id,
                    'photo' => $a_photo
                ]);
            DB::table('answers')
                ->insert([
                    'answer' => $req->b_answer,
                    'correct' => $b_correct,
                    'quiz_id' => $quiz_id->id,
                    'photo' => $b_photo
                ]);
            DB::table('answers')
                ->insert([
                    'answer' => $req->c_answer,
                    'correct' => $c_correct,
                    'quiz_id' => $quiz_id->id,
                    'photo' => $c_photo
                ]);
            DB::table('answers')
                ->insert([
                    'answer' => $req->d_answer,
                    'correct' => $d_correct,
                    'quiz_id' => $quiz_id->id,
                    'photo' => $d_photo
                ]);
            return redirect(route('view_subject',['id' => $req->subject_id]));
//            return $req;
        }
        else{
            return abort(404);
        }
    }

    //    Fan savolini o'chiradi
    public function subject_delete(Request $req)
    {
        if (session('admin') == "1"){
            $quiz = DB::table('quizzes')
                ->where('id',$req->id)
                ->first();
            if ($quiz->photo != "no_photo"){
                unlink('quiz_images/'.$quiz->photo);
            }
            $answers = DB::table('answers')
                ->where('quiz_id',$quiz->id)
                ->get(['*']);
            foreach ($answers as $item){
                if ($item->photo != "no_photo"){
                    unlink('answer_images/'.$item->photo);
                }
                DB::table('answers')
                    ->delete($item->id);
            }
            DB::table('quizzes')
                ->delete($quiz->id);
            return redirect(route('view_subject',['id' => $req->subject_id]));
        }
        else{
            return abort(404);
        }
    }

    //    Fan savolini ko'rish
    public function subject_view($id)
    {
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $quiz = DB::table('quizzes')
                ->where('id',$id)
                ->first();
            $answers = DB::table('answers')
                ->where('quiz_id',$id)
                ->get(['*']);
            return view('admin.subject_quiz',['compulsory' => $compulsory,'all_subject'=>$all_subject,'quiz'=>$quiz,'answers'=>$answers]);
        }
        else{
            return abort(404);
        }
    }
}
