<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function Form()
    {
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            return view('admin.news.new',['compulsory' => $compulsory,'all_subject'=>$all_subject]);
        }
        else{
            return abort(404);
        }
    }

    public function Show()
    {
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $news = DB::table('news')
                ->latest()
                ->paginate(10);
            return view('admin.news.all',['news'=>$news,'compulsory' => $compulsory,'all_subject'=>$all_subject]);
        }
        else{
            return abort(404);
        }
    }

    public function Reg(Request $req)
    {
        $req->validate([
            'title'=>'required',
            'body'=>'required',
            'photo'=>'required'
        ]);

        $photo = $req->file('photo');
        $name = md5(microtime());
        $file = $req->file('photo')->extension();
        $dir = "news_images/";
        $photo->move($dir, $name.".".$file);
        $news_photo = $name.".".$file;

        DB::table('news')
            ->insert([
                'title' => $req->title,
                'body' => $req->body,
                'photo' => $news_photo
            ]);

        return redirect(route('news_admin'));
    }

    public function View($id)
    {
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $new = DB::table('news')
                ->where('id', $id)
                ->first();
            if (empty($new)) {
                return abort(404);
            }
            return view('admin.news.view',['new'=>$new,'compulsory' => $compulsory,'all_subject'=>$all_subject]);
        }
        else{
            return abort(404);
        }
    }

    public function Delete(Request $req)
    {
        if (session('admin') == "1"){
            $req->validate([
                'id' => 'required'
            ]);
            $new = DB::table('news')
                ->where('id', $req->id)
                ->first();
            unlink('news_images/'.$new->photo);
            DB::table('news')
                ->where('id', $req->id)
                ->delete();
            return redirect(route('news_admin'));
        }
        else{
            return abort(404);
        }
    }

    public function Edit($id)
    {
        if (session('admin') == "1"){
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $new = DB::table('news')
                ->where('id', $id)
                ->first();
            if (empty($new)) {
                return abort(404);
            }
            return view('admin.news.edit',['new'=>$new,'compulsory' => $compulsory,'all_subject'=>$all_subject]);
        }
        else{
            return abort(404);
        }
    }

    public function Update(Request $req)
    {
        $req->validate([
            'title'=>'required',
            'body'=>'required',
            'id' => 'required',
            'photo_old' => 'required'
        ]);

        if ($req->hasFile('photo')){
            $photo = $req->file('photo');
            $name = md5(microtime());
            $file = $req->file('photo')->extension();
            $dir = "news_images/";
            $photo->move($dir, $name.".".$file);
            $quiz_photo = $name.".".$file;
            unlink('news_images/'.$req->photo_old);
            DB::table('news')
                ->where('id', $req->id)
                ->update([
                    'title' => $req->title,
                    'body' => $req->body,
                    'photo' => $quiz_photo
                ]);
        }
        else {
            DB::table('news')
                ->where('id', $req->id)
                ->update([
                    'title' => $req->title,
                    'body' => $req->body,
                ]);
        }
        return redirect(route('news_view', ['id' => $req->id]));
    }
}