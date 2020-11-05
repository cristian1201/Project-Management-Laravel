<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('role:admin');
//        $this->middleware('role:user', ['only' => ['edit', 'update']]);
    }
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        $teams = Team::pluck('name','id')->all();
        $teams = Arr::add($teams,  "", "no team");
        $positions = [
            "0"=>"Team leader",
            "1"=>"Senior team member",
            "2"=>"Junior team member",
            null=>"no position"
        ];
        return view('users.create',compact('roles', 'teams', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['nullable', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'telephone' => ['required', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'same:confirm-password'],
            'roles' => 'required',
            'team_id' => 'nullable',
            'position' => 'nullable'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
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
        return view('users.edit',compact('user','roles','userRole', 'teams', 'userTeam', 'positions', 'userPosition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['nullable', 'string', 'max:255'],
//            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'telephone' => ['required', 'numeric'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'same:confirm-password',
            'roles' => 'required',
            'team_id' => 'nullable',
            'position' => 'nullable'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success','User deleted successfully');
    }
}
