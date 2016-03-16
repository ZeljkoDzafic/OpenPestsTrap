<?php

namespace App\Http\Controllers;

use App\Battery;
use App\ErrorLog;
use App\Images;
use App\Network;
use App\Notifications;
use App\Pest_image;
use App\Traps;
use App\User;
use Illuminate\Http\Request;
use DateTime;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TrapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $networks = array_add(Network::where('user_id', Auth::user()->id)->lists('name', 'id'), 0, 'Default');
        $notifications = Notifications::latest()->get();
        return view('traps.create')->with('networks', $networks)->with('notifications', $notifications);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|min:3',
            'pests_network_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'start_date' => 'required',
        ]);

        $uuid = Auth::user()->id;
        $trap = $request->all();
        $trap['user_id'] = $uuid;
        Traps::create($trap);
        return redirect(route('network.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trap = Traps::findOrFail($id);

        if ($trap->user_id != Auth::user()->id)
            return redirect(route('network.index'));

        $images = Images::where('trap_id', $id)->get();
        $error_logs = ErrorLog::where('trap_id', $id)->get();
        return view('traps.show')->with('trap', $trap)->with('images', $images)->with('error_logs', $error_logs);
    }

    public function changePlate($id)
    {

        $trap = Traps::findOrFail($id);

        $trap['plate_counter'] = intval($trap['plate_counter']) + 1;


        $trap->update();
        return redirect(route('network.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trap = Traps::findOrFail($id);
        $trap['network'] = array_add(Network::lists('name', 'id'), 0, 'Default');

        if ($trap->user_id != Auth::user()->id)
            return redirect(route('network.index'));
        $notifications = Notifications::latest()->get();
        return view('traps.edit')->with('trap', $trap)->with('notifications', $notifications);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function getImage($id)
    {
        $image = Images::findOrFail($id);
        $trap = Traps::findOrFail($image->trap_id);
        if ($trap->user_id != Auth::user()->id)
            return redirect(route('network.index'));
        $image->user_id = $trap->user_id;
        return view('traps.add_image')->with('image', $image);
    }

    public function postImage(Request $request, $id)
    {
        $image = Images::findOrFail($id);
        /*$images['trap_id'] = $id;
        $images['plate_number'] = Traps::where('id', $id)->value('plate_counter');

        $images['unique_id'] = uniqid();
        $images['image'] = $images['unique_id'];*/
        $image->number_of_pests = intval($request['number']) + 1;
        $image->save();
        $id = $image->id;
        $pest_image['id_pest_image'] = $id;

        for ($i = 0; $i <= $request['number']; $i++) {
            $arr = explode(',', $request[$i . '_hidden']);
            $pest_image['name_of_pest'] = $request[$i];
            $pest_image['x'] = $arr[1];
            $pest_image['y'] = $arr[2];
            $pest_image['width'] = $arr[3];
            $pest_image['height'] = $arr[4];
            Pest_image::create($pest_image);
        }
        return redirect(route('network.index'));

    }

    public function editImage($id)
    {
        $image = Images::findOrFail($id);
        $trap = Traps::findOrFail($image->trap_id);
        $image->user_id = $trap->user_id;
        $areas = Pest_image::where('id_pest_image', $id)->get();
        $notifications = Notifications::latest()->get();
        return view('traps.edit_image')->with('image', $image)->with('areas', $areas)->with('notifications',$notifications);
    }

    public function updateImage($id, Request $request)
    {
        $image = Images::findOrFail($id);
        $image->number_of_pests = intval($request['number']) + 1;
        $image->save();
        $id = $image->id;
        $pest_image['id_pest_image'] = $id;
        Pest_image::where('id_pest_image', $id)->delete();
        for ($i = 0; $i <= $request['number']; $i++) {
            $arr = explode(',', $request[$i . '_hidden']);
            $pest_image['name_of_pest'] = $request[$i];
            $pest_image['x'] = $arr[1];
            $pest_image['y'] = $arr[2];
            $pest_image['width'] = $arr[3];
            $pest_image['height'] = $arr[4];
            Pest_image::create($pest_image);
        }
        return redirect(route('network.index'));

    }

    public function update(Request $request, $id)
    {
        $trap = Traps::findOrFail($id);
        if ($trap->user_id != Auth::user()->id)
            return redirect(route('network.index'));
        $this->validate($request, ['name' => 'required|min:3',
            'pests_network_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'start_date' => 'required',
        ]);


        $trap->update($request->all());
        return redirect(route('network.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trap = Traps::findOrFail($id);
        $trap->status = 0;
        $trap->update();
        return redirect(route('netwok.index'));
    }

    public function uploadImage($id, Request $request)
    {
        if ($request->hasFile('file')) {
            $trap = Traps::findOrFail($id);
            $user_id = Traps::findOrFail($trap->id);
            $unique_id = uniqid() . '_' . uniqid();
            $imageName = $unique_id . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move(
                base_path() . '/public/uploads/images/' . $user_id->user_id . '/', $imageName
            );

            $image['plate_number'] = $trap->plate_counter;
            $image['unique_id'] = $unique_id;
            $image['image'] = $imageName;
            $image['trap_id'] = $id;
            $i = Images::create($image);
            return redirect(route('image', $i->id));
        } else
            return Redirect::back()->withInput()->withErrors('Morate unijeti file za oglas');
    }


    public function publicIndex()
    {
        $t = Traps::where('is_public', 1)->where('status', 1)->get();
        foreach ($t as $trap) {
            $trap['battery'] = Battery::where('traps_id', $trap['id'])->value('level');
        }
        return view('home.public_index')->with('traps', $t);
    }

    public function publicShow($id)
    {
        $trap = Traps::findOrFail($id);

        $images = Images::where('trap_id', $id)->get();
        return view('home.show_trap')->with('trap', $trap)->with('images', $images);
    }

}
