<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Http\Requests\User\ShowUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Polo;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->query('type', '');
        if (empty($type)) 
            $type = ['student','teacher','coordinator','director','financial','secretary'];
        $name = $request->query('name', '');
        $users = User::role($type)->where('name', 'like', "%$name%")->paginate();
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->pluck('name');
        $polos = Polo::all();
        return view('users.create', ['roles' => $roles, 'polos' => $polos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $pass = Str::random(8);
            $request->merge(['password' => $pass]);
            $user = User::create($request->all());
            $user->syncRoles($request->roles);
            notify()->success('Criado com sucesso!');
            return redirect()->route('users.index')->withSuccess(['message' => "Senha gerada: $pass"]);
        } catch(Exception $ex) {
            notify()->error("Erro. $ex");
        }
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowUserRequest $request, User $user)
    {
        $roles = Role::all()->pluck('name');
        return view('users.show', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EditUserRequest $request, $id)
    {
        $user = User::find($id);
        $roles = Role::all()->pluck('name');
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $user->syncRoles($request->roles);
            $user->fill($request->all());
            $user->save();
            notify()->success('Atualizado com sucesso!');
        } catch(Exception $ex) {
            notify()->error('Erro.');
        }
        return redirect()->route('users.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteUserRequest $request, $id)
    {
        try{
            User::destroy($id);
        } catch(Exception $ex){
            notify()->error('Erro.');
        }
        return redirect()->route('users.index');
    }

    public function classrooms(User $user){
        if ($user->hasRole('teacher')){
            $classes = $user->classrooms_teacher;
        } else{
            $classes = $user->classrooms;
        }
        return view('classes.index', ['classes' => $classes]);
    }
}
