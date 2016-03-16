<?php

namespace App\Http\Controllers;

use App\Notifications;
use App\User;
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
        $users=User::all();
        return view('users.index')->with('users',$users);
    }

    public function admin($id)
    {
        $user = User::findOrFail($id);
        $user->admin = 1;
        $user->save();
        return redirect(route('users.index'));
    }


    public function user($id)
    {
        $user = User::findOrFail($id);
        $user->admin = 0;
        $user->save();
        return redirect(route('users.index'));
    }

    public function editUser($id)
    {
        if($id != Auth::user()->id)
            return redirect(route('network.index'));

        $user = User::findOrFail($id);
        $notifications = Notifications::latest()->get();
        return view('users.user_change')->with('user',$user)->with('notifications',$notifications);
    }

    public function updateUser($id,Request $request)
    {
        $this->validate($request,['password'=>'required|min:6|confirmed']);
        if($id != Auth::user()->id)
            return redirect(route('network.index'));

        $user = User::findOrFail($id);
        $user->update($request->all());
        if($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();
        return redirect(route('network.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user=User::findOrFail($id);
        return view('users.edit')->with('user',$user);

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
        $user = \App\User::findOrFail($id);
        $this->validate($request, [
            'email' => 'required|unique:users,email',
            'password' => 'min:6|confirmed'
        ]);
        $user->email = $request['email'];
        if($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();
        return redirect(route('users.index'));
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
