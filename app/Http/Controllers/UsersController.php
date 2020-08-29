<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::orderBy('id', 'desc')->paginate(5);
        // return $users;
        return view('users.index', ['users' => $users]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::get();
        return view('users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
       
        $user->assignRole($request->role);
        // 保存後 一覧ページへリダイレクト
        return redirect('/users');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // 引数で受け取った$idを元にfindでレコードを取得
        $user = User::find($id);
        // viewにデータを渡す
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        $roles = Role::get();
        $userRoles = $user->getRoleNames();
        $userRoleName = (!empty($userRoles[0])) ? $userRoles[0] : "";
        return view('users.edit', ['user' => $user, 'roles' => $roles, 'userRoleName' => $userRoleName]);
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
        //
        // idを元にレコードを検索して$userに代入
        $user = User::find($id);
        // editで編集されたデータを$userにそれぞれ代入する
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->has('password')) {
            if ($request->password == $request->password_confirmation) {
                
                $user->password = Hash::make($request->password);
            }
        }       
        $user->save();

        $user->syncRoles($request->role);
        // 詳細ページへリダイレクト
        return redirect("/users/".$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // idを元にレコードを検索
       $user = User::find($id);
       // 削除
       $user->delete();
       // 一覧にリダイレクト
       return redirect('/users');        
    }
}
