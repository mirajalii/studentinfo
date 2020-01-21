<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\StudentRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Kyslik\ColumnSortable\Sortable;
use View;
use Response;
use DB;
use Arr;
use Gate;

class SudentsInfoController extends Controller
{
    
    public function index()
    {
        

    }

    public function studentRecords(Request $request)
    {
        $students = null;

        $inputs = $request->all();

        if(Arr::get($inputs, 'name' ,$inputs, 'class',$inputs, 'age')){

            $name = Arr::get($inputs, 'name');

            $class = Arr::get($inputs, 'class');

            $age = Arr::get($inputs, 'age');

            $students = Student::where('name', 'like', '%'.$name.'%')
        
                                ->where('class', 'like', '%'.$class.'%')
                            
                                ->where('age', 'like', '%'.$age.'%')
                            
                                ->paginate(5);
        }
        elseif(Arr::get($inputs, 'name' ,$inputs, 'class'))
        {
        
            $name = Arr::get($inputs, 'name');
        
            $class = Arr::get($inputs, 'class');
        
            $students = Student::where('name', 'like', '%'.$name.'%')
        
                                ->where('class', 'like', '%'.$class.'%')
                            
                                ->paginate(5);

        }elseif(Arr::get($inputs, 'name')){

            $name = Arr::get($inputs, 'name');
            
            $students = Student::where('name', 'like', '%'.$name.'%')
            
                                ->paginate(5);
        }

        $html = View::make('ajax', compact('students'))->render();

        return Response::json(['html' => $html]);

    }

    public function list(Request $request)
    {
        
        $inputs = $request->all();

        $students = Student::sortable()->paginate(5);
        
        return view('studentinfo.lists', [
        
            'students' => $students,
        
            ]);

    }
    public function store(Request $request) 
    {
        request()->validate([
            'name' => ['required','min:3'],
            'roll_no' => ['required',Rule::unique('Students_Info')],
            'class' => ['required'],
            'age' => ['required'],
            'gender' => ['required'],
            'hobies' => ['required'],
        ]);

        $student = new Student;

        $inputs = $request->all();
        

        // dd($inputs);
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

        $request->session()->flash('alert-success', 'Student was successful added!');
        return redirect()->route('lists');
    }

    public function create(Request $request)
    {
        if(Gate::allows('public')) {
            return view('studentinfo.create');
        }else{
            $request->session()->flash('alert-success', 'Only admin can add the student info');
            return back();
        }

    
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

        // dd($inputs); 

        if($request->has('image'))
        {
            
            $image = $inputs['image'];
            
            // dd($image);
            if($studentImage)
            {
                if(File::exists('assets/images/' . $studentImage)) {
        
                    unlink('assets/images/'.$studentImage);
                
                }
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
        $request->session()->flash('alert-success', 'Student record was successful updated!');
        return redirect()->route('lists');
    
    }

    public function desktroy($id, Request $request)
    {
        if(Gate::allows('public')) {
            $student = Student::where('id', $id)->first();
            // $student = Student::where('id', $id)->first()->delete();
            $studentImage = $student->image;



            if($student->image != null){

                if(File::exists('assets/images/' . $studentImage)) {
            
                    unlink('assets/images/'.$studentImage);
                
                }
            }
            
            $student->delete();

            return redirect()->route('lists');
        }else{
            $request->session()->flash('alert-success', 'You have not access to Delete student details');
            return back();
        }
    }

    public function edit($id, Request $request)
    {
        if(Gate::allows('public')) {
            $student = Student::where('id', $id)->first();

            return view('studentinfo.update', [
                'id' => $id,
                'student' => $student,
            ]);
        }else{
            $request->session()->flash('alert-success', 'You have not access to edit student details');

            return back();
        }
    }

    public function deleteImage($id,Request $request)
    {

        $student = Student::where('id', $id)->first();

        $studentImage = Student::find($id)->image;


        if($studentImage != null){

            if(File::exists('assets/images/' . $studentImage)) {
        
                unlink('assets/images/'.$studentImage);
                            
            }
        }

        $student->image = null;

        $student->update($request->all());

        return back();
    }

}
