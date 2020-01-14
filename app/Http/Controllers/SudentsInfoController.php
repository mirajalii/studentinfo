<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\StudentRequest;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use DB;
use Arr;

class SudentsInfoController extends Controller
{

    public function index()
    {

    }

    // public function list()
    // {
    //     $students = Student::get();
    //     return view('studentinfo.lists', [
    //         'students' => $students,
    //     ]);
    // }

    public function search(Request $request)
    {
        // $q = new Student;
        // $q = $request->input('name');
        // dd($q);
            $q = Student::get();
            $user = Student::where('name','LIKE','%miraj%')->get();
            // dd($user);
            if(count($user) > 0){
                dd($user[0]);
                return view('studentinfo.lists', [
                    'students' => $q,
                ]);
            }
            else 
            {
                return view ('welcome')->withMessage('No Details found. Try to search again !');
            }
        

        // $inputs = $request->all();
        // dd($inputs);

        if($request->ajax())
        {
            return view('studentinfo.search');

        }
        else
        {
            $students = Student::get();
                return view('studentinfo.lists', [
                'students' => $students,
            ]);
        }
        

    }


    public function store(Request $request) 
    {
        $student = new Student;

        $inputs = $request->all();
        $imageUrl = $this->imageStorage(Arr::get($inputs, 'image'));
        $inputs['image'] = $imageUrl;
        // dd($imageUrl);
        /* $student->name = $inputs['name'];
        $student->age = $inputs['name'];
        $student->image = $inputs['name'];
        $student->ncalssame = $inputs['name'];
        $student->name = $inputs['name'];
        $student->name = $inputs['name'];
        $student->name = $inputs['name']; */
        // dd($inputs);
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
        $student->update($request->all());

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

    private function imageStorage($file)
    {
        $imageUrl = null;

        if(!is_null($file)) {
            $path = Storage::putFile('public/images', $file);
            $imageUrl = env('APP_URL').Storage::url($path);
        }

        return $imageUrl;

    }
}
