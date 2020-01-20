<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {  
        $inputs = $request->all();

        $students = Student::sortable()->paginate(5);
        
        return view('studentinfo.lists', [
        
            'students' => $students,
        
        ]);
    }
}
