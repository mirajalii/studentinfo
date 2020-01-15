<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\StudentRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use DB;
use Arr;

class SudentsInfoController extends Controller
{

    public function index()
    {


    }

    public function list()
    {
        $students = Student::paginate(5);
        return view('studentinfo.lists', [
            'students' => $students,
        ]);
    }

    public function search(Request $request)
    {
        
    }


    public function store(Request $request) 
    {
        request()->validate([
            'name' => ['required','min:3'],
            'roll_no' => ['required'],
            'class' => ['required'],
            'age' => ['required'],
            'gender' => ['required'],
            'hobies' => ['required'],
        ]);
        $student = new Student;

        $inputs = $request->all();

        $image = $inputs['image'];

        $new_name = time() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('assets/images'), $new_name);

        $imageUrl = $new_name;

        $inputs['image'] = $imageUrl;

        $student = Student::create($inputs);

        return redirect()->route('lists');
    }

    public function create()
    {

        return view('studentinfo.create');
    
    }

    public function show()
    {

    }

    public function update($id, Request $request)
    {
        $student = Student::where('id', $id)->first();

        $studentImage = Student::find($id)->image;

        $inputs = $request->all();

        if($request->has('image'))
        {

            $image = $inputs['image'];
            
            if(File::exists('assets/images/' . $studentImage)) {
    
                unlink('assets/images/'.$studentImage);
            
            }

            $new_name = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('assets/images'), $new_name);

            $imageUrl = $new_name;

            $inputs['image'] = $imageUrl;

            $student->update($request->all());

            $student->image = $imageUrl;

            $student->save();

        }
        else{
            $student->update($request->all());
        }

        return redirect()->route('lists');
    
    }

    public function desktroy($id)
    {
        $student = Student::where('id', $id)->first()->delete();

        return redirect()->route('lists');
    }

    public function edit($id)
    {
        $student = Student::where('id', $id)->first();

        return view('studentinfo.update', [
            'id' => $id,
            'student' => $student,
        ]);
    }

}
