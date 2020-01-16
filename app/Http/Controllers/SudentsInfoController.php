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

    public function studentRecords(Request $request)
    {
        $students = null;
        $inputs = $request->all();

        if(Arr::get($inputs, 'name')){
            $name = Arr::get($inputs, 'name');
            $students = Student::where('name', 'like', '%'.$name.'%')->paginate(5);
        }

        return response()->json([
            'data' => $students,
        ]);


    }

    public function list(Request $request)
    {
        
        $inputs = $request->all();
        $students = Student::sortable()->paginate(5);
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

        $inputs = array(
            'students_info' => Student::get(),
        );

        dd($inputs);
        $inputs = $request->all();

        $inputs['image'] = null;

        if($request->has('image'))
        {

            $image = $inputs['image'];

            $new_name = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('assets/images'), $new_name);

            $imageUrl = $new_name;

            $inputs['image'] = $imageUrl;

            $student = Student::create($inputs);

        }else{

            $student = Student::create($inputs);
        }


        return redirect()->route('lists');
    }

    public function create()
    {

        return view('studentinfo.create');
    
    }

    public function show($id,Request $request)
    {
        $students = Student::where('id', $id)->first();
        return view('studentinfo.single', [
            'students' => $students,
        ]);
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

    public function deleteImage(Request $id, $request){
        $Student = Student::find($request->id);
        
    }

}
