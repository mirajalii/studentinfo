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
        $inputs = $request->all();

            $students = Student::sortable()->paginate(5);

            return view('studentinfo.lists', [

            'students' => $students,
            
        ]);
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

            return back();
        
        }else{

            $request->session()->flash('alert-success', 'Only edit could edit the Roles');

            return back();
        
        }
        
    }

    public function userEdit($id,Request $request){
        
        if(Gate::allows('public')) {

            $user = User::where('id',$id)->first();
            
            return view('Auth.userupdate',[

                'users' => $user

            ]);

        }
        else{

            $request->session()->flash('alert-success', 'Uou have not access to edit user');

            return back();

        }
    }

    public function userUpdate($id,Request $request){

        if(Gate::allows('public')) {

            $users = User::where('id',$id)->first();

            $inputs = $request->all();

            $users->update($inputs);

            $request->session()->flash('alert-success', 'User detail success fully update');

            return redirect()->route('users');
        }
        else
        {
            $request->session()->flash('alert-success', 'You have not access to edit user');

            return back();
        }
    }
}
