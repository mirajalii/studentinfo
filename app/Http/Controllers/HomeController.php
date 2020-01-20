<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;

use App\User;

use DB;

use Gate;

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
        if (Gate::allows('public')) {
                $inputs = $request->all();
                $students = Student::sortable()->paginate(5);
                return view('studentinfo.lists', [
                'students' => $students,
            ]);

        }else{
            $request->session()->flash('alert-success', 'you are not a authorized user');
            return view('welcome');
        }
       
    }
    public function roleuser(Request $request){
        $users = DB::table('users')->get();
        return view('role',[
            'users' => $users,
        ]);

    }
    public function roleedit($id,Request $request){
        if(Gate::allows('public')) {
         
            $users = User::where('id',$id)->first();

            $users->roles = $request->roles;

            $users->save();

            return ;
        
        }else{

            $request->session()->flash('alert-success', 'Only edit could edit the Roles');

            return back();
        
        }

        
    }

}
