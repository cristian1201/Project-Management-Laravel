<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TeamController extends Controller
{
    function __construct()
    {
        $this->middleware('role:admin');
//        $this->middleware('role:team', ['only' => ['edit', 'update']]);
    }

    public function index(Request $request)
    {
        $data = Team::orderBy('id', 'DESC')->with('users')->paginate(5);
        return view('teams.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name', 'id')->all();
        $users = Arr::add($users, "", "not selected");
        $type = [ 'Production' => 'Production', 'Trash' => 'Trash', 'Control' => 'Control'];
        $positions = ['Team leader', 'Senior team member', 'Junior team member'];

        return view('teams.create', compact('users', 'type', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255', 'unique:teams'],
            'gps_x' => ['required', 'numeric'],
            'gps_y' => ['required', 'numeric'],
            'type' => ['required', 'string'],
            'users' => ['required', 'array'],
            'positions' => ['required', 'array'],
        ]);

        $input = $request->all();

        $team = Team::create($input);
        for ($i=0; $i<count($input['users']); $i++) {
            if(!$input['users'][$i]) continue;
            $user = User::find($input['users'][$i]);
            $user->team_id = $team->id;
            $user->position = $input['positions'][$i];
            $user->save();
        }

        return redirect()->route('teams.index')
            ->with('success', 'Team created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::find($id);
        return view('teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Team::find($id);
        $users = User::pluck('name', 'id')->all();
        $users = Arr::add($users, "", "not selected");
        $type = [ 'Production' => 'Production', 'Trash' => 'Trash', 'Control' => 'Control'];
        $positions = ['Team leader', 'Senior team member', 'Junior team member'];
        $teamUsers = $team->users();
        return view('teams.edit', compact('team', 'users', 'teamUsers', 'type', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
//            'name' => ['required', 'string', 'max:255', 'unique:teams'],
            'gps_x' => ['required', 'numeric'],
            'gps_y' => ['required', 'numeric'],
            'type' => ['required', 'string'],
            'users' => ['required', 'array'],
            'positions' => ['required', 'array'],
        ]);

        $input = $request->all();

        $team = Team::find($id);

        if($team->name != $input['name'] && Team::where('name', $input['name'])->count()!=0)
            return redirect()->back()
                ->with('failed','TeamName is duplicated');

        $team->update($input);

        foreach ($team->users as $user) {
            $user->releaseTeam();
        }
        for ($i=0; $i<count($input['users']); $i++) {
            if($input['users'][$i]=="") continue;
            $user = User::find($input['users'][$i]);
            $user->team_id = $id;
            $user->position = $input['positions'][$i];
            $user->save();
        }

        return redirect()->route('teams.index')
            ->with('success', 'Team updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::find($id);
        foreach ($team->users as $user) {
            $user->releaseTeam();
        }
        $team->delete();
        return redirect()->route('teams.index')
            ->with('success', 'Team deleted successfully');
    }
}