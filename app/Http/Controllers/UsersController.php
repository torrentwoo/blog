<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.logon')->with('logonActive', 'active');
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
            'username'  =>  'required|between:4,32|unique:users,name', // all printable characters are accepted
            //'username'  =>  ['required', 'min:4', 'max:32', 'regex:/^[a-z]+[\x2d\x2e\x5f]?[a-z\d]+?$/'], // pattern
            'email'     =>  'required|email|unique:users|max:255',
            'password'  =>  'required|min:6|confirmed',
        ]);
        $user = User::create([
            'name'  =>  $request->username,
            'email' =>  $request->email,
            'password'  =>  bcrypt($request->password),
        ]);
        //Auth::login($user); // login when register succeed
        session()->flash('success', '注册成功，欢迎您在这里开启一段新的旅程');

        return redirect()->route('home')->with('user', $user);
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
    }
}
