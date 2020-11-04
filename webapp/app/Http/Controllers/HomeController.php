<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
    public function index()
    {
        return view('home');
    }

    public function editProfile() {
        $user = User::find(Auth::id());
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $teams = Team::pluck('name','id')->all();
        $teams = Arr::add($teams,  "", "no team");
        $userTeam = $user->team_id;
        $positions = [
            "0"=>"Team leader",
            "1"=>"Senior team member",
            "2"=>"Junior team member",
            null=>"no position"
        ];
        $userPosition = $user->position;
        return view('profile',compact('user','roles','userRole', 'teams', 'userTeam', 'positions', 'userPosition'));
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['nullable', 'string', 'max:255'],
//            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'telephone' => ['required', 'numeric'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'same:confirm-password',
//            'roles' => 'required',
//            'team_id' => 'nullable',
//            'position' => 'nullable'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = Auth::user();
        if($user->username != $input['username'] && User::where('username', $input['username'])->count()!=0)
            return redirect()->back()
                ->with('failed','Username is duplicated');
        if($user->email != $input['email'] && User::where('email', $input['email'])->count()!=0)
            return redirect()->back()
                ->with('failed','E-mail is duplicated');
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',Auth::id())->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('home')
            ->with('success','User updated successfully');
    }

}
