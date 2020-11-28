<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::all());
    }

    // 保存
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->input('name', '');
        $user->password = $request->input('password', '');

        $user->save();
    }

    // １データ表示
    public function show(User $user)
    {
        return new UserResource($user);
    }

    // 更新
    public function update(Request $request, User $user)
    {
        $user->name = $request->input('name', '');
        $user->password = $request->input('password', '');

        $user->save();
    }

    // 削除
    public function destroy(User $user)
    {
        $user->delete();
    }
}
