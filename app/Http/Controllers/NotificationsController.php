<?php

namespace App\Http\Controllers;

use App\Notifications;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notifications::all();
        return view ('Notifications.index',compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Notifications::create($request->except('_token'));
        return redirect(route('notifications.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = Notifications::findOrFail($id);
        return view('Notifications.show',compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notification = Notifications::findOrFail($id);
        return view('Notifications.edit',compact('notification'));
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
        $notification = Notifications::findOrFail($id);
        $notification->update($request->all());
        return redirect(route('notifications.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = Notifications::findOrFail($id);
        $notification->delete();
        return redirect(route('notifications.index'));
    }

    public function delete()
    {
        $id = Input::only('id');
        

        Notifications::destroy($id);
        return redirect(route('notifications.index'));
    }

    public function read()
    {
        $id = Input::only('id');
        $notification = Notifications::findOrFail($id);
        $n = json_encode($notification);
        return Response::json($n);
    }
}
