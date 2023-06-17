<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DirectionController extends Controller
{
    public function univeresities(){
        if (session('admin') == "1") {
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $uni = DB::table('universities')
                ->latest()
                ->get(['*']);
            return view('admin.directions.universities', ['compulsory' => $compulsory, 'all_subject' => $all_subject, 'uni' => $uni]);
        }
        else{
            return abort(404);
        }
    }

    public function new_uni_reg(Request $req){
        if (session('admin') == "1") {
            DB::table('universities')
                ->insert([
                    'name'=>$req->name
                ]);
            return redirect(route('universities'));
        }
        else{
            return abort(404);
        }
    }

    public function edit($id){
        if (session('admin') == "1") {
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $dir = DB::table('directions')
                ->where('id', $id)
                ->first();
            $uni = DB::table('universities')
                ->get(['*']);
            return view('admin.directions.edit', ['uni' => $uni, 'compulsory' => $compulsory,'all_subject' => $all_subject,'dir' => $dir]);
        }
        else{
            return abort(404);
        }
    }

    public function update(Request $req)
    {
        if(count($req->input()) != 10){
            return back();
        } 
        else {
            $uni = DB::table('universities')
                ->where('id', $req->uni_id)
                ->first();
            $f = DB::table('subjects')
                ->where('id', $req->first_subject)
                ->first();
            $s = DB::table('subjects')
                ->where('id', $req->second_subject)
                ->first();
            DB::table('directions')
                ->where('id', $req->id)
                ->update([
                    'name' => $req->name,
                    'university_id' => $uni->id,
                    'uni_name' => $uni->name,
                    'first_subject_id' => $f->id,
                    'second_subject_id' => $s->id,
                    'first_subject_name' => $f->name,
                    'second_subject_name' => $s->name,
                    'grand' => $req->grand,
                    'kontrakt' => $req->kontrakt,
                    'lang' => $req->lang,
                    'type' => $req->type
                ]);
            return redirect()->route('directions');
        }
    }

    public function directions(){
        if (session('admin') == "1") {
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $uni = DB::table('directions')
                ->latest()
                ->paginate(30);
            $univsities = DB::table('universities')
                ->get(['*']);
            return view('admin.directions.directions', ['compulsory' => $compulsory,'universities'=>$univsities, 'all_subject' => $all_subject, 'directions' => $uni]);
        }
        else{
            return abort(404);
        }
    }

    public function new_direct(){
        if (session('admin') == "1") {
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $univsities = DB::table('universities')
                ->get(['*']);
            return view('admin.directions.new_direct', ['compulsory' => $compulsory,'all_subject' => $all_subject,'uni'=>$univsities]);
        }
        else{
            return abort(404);
        }
    }

    public function new_direct_reg(Request $req)
    {
        if (session('admin') == "1") {
            $first_subject = DB::table('subjects')
                ->where('id', $req->first_subject)
                ->first();
            $second_subject = DB::table('subjects')
                ->where('id', $req->second_subject)
                ->first();
            $uni = DB::table('universities')
                ->where('id', $req->university_id)
                ->first();
            if ($req->type == "1") {
                DB::table('directions')
                    ->insert([
                        'name' => $req->name,
                        "university_id" => $req->university_id,
                        "uni_name" => $uni->name,
                        'first_subject_id' => $req->first_subject,
                        'second_subject_id' => $req->second_subject,
                        'first_subject_name' => $first_subject->name,
                        'second_subject_name' => $second_subject->name,
                        'grand' => $req->grand,
                        'kontrakt' => $req->kontrakt,
                        'lang' => $req->lang,
                        'type' => $req->type
                    ]);
            }
            elseif ($req->type == "2") {
                DB::table('directions')
                    ->insert([
                        'name' => $req->name,
                        "university_id" => $req->university_id,
                        'first_subject_id' => $req->first_subject,
                        'second_subject_id' => $req->second_subject,
                        'first_subject_name' => $first_subject->name,
                        'second_subject_name' => $second_subject->name,
                        'kontrakt' => $req->kontrakt,
                        'lang' => $req->lang,
                        'type' => $req->type
                    ]);
            }
            return redirect(route('directions'));
        } else {
            return abort(404);
        }
    }

public function direct_delete(Request $req){
    if (session('admin') == "1") {
        DB::table('directions')
            ->delete($req->id);
        return redirect(route('directions'));
    }
    else{
        return abort(404);
    }
}

    public function directFilter($id){
        if (session('admin') == "1") {
            $compulsory = DB::table('compulsory_subjects')
                ->get(['*']);
            $all_subject = DB::table('subjects')
                ->get(['*']);
            $uni = DB::table('directions')
                ->where('university_id',$id)
                ->latest()
                ->paginate(30);
            $univsities = DB::table('universities')
                ->get(['*']);
            session()->flash('uni_id',$id);
            return view('admin.directions.directions', ['compulsory' => $compulsory,'universities'=>$univsities, 'all_subject' => $all_subject, 'directions' => $uni]);
        }
        else{
            return abort(404);
        }
    }

    public function deleteUni(Request $req){
        if (session('admin') == "1") {
            DB::table('universities')
                ->delete($req->id);
            DB::table('directions')
                ->where('university_id',$req->id)
                ->delete($req->id);
            return redirect(route('universities'));
        }
        else{
            return abort(404);
        }
    }


}
