<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
            'name'      =>  $request->username,
            'email'     =>  $request->email,
            'password'  =>  bcrypt($request->password),
        ]);
        // Send an account activation message to user via mail
        $this->sendActivationMessage($user);

        session()->flash('success', '注册验证通知邮件已经发送到您的注册邮箱，请注意查收');

        return view('layouts.activation')->with('user', $user);
    }

    /**
     * Send an account activation message to specified user
     *
     * @param \App\Models\User $recipient
     */
    public function sendActivationMessage(User $recipient)
    {
        $view     = 'features.activation';
        $user     = $recipient;
        $data     = compact('user');
        $from     = 'admin@dev.local';
        $fromName = 'admin';
        $to       = $user->email;
        $subject  = '注册验证通知邮件';
        Mail::send($view, $data, function($message) use ($from, $fromName, $to, $subject) {
            $message->from($from, $fromName)->to($to)->subject($subject);
        });
    }

    /**
     * Activate a specified user with a token
     *
     * @param string $token the value of activation token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate($token)
    {
        $user = User::where('activation_token', '=', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save(); // update

        Auth::login($user);
        $nickname = $user->nickname;
        $nickname = $nickname ?: $user->name;
        session()->flash('success', "恭喜您：{$nickname}，您的账户已成功激活，祝愿您在这里开启一段愉快的旅程");

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
        $user = User::findOrFail($id);
        return view('users.show')->with('user', $user);
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
