<?php

namespace App\Http\Controllers;

use App\Driver;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class DriverController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

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
    public function create(Request $data)
    {
        $contact = $data->all();
        $contact['data'] = json_decode($contact['data'],true);

        $user = User::updateOrCreate(['id' => $contact['data']['info']['id']],[
            'name' => $contact['data']['info']['name'],
            'email' => $contact['data']['info']['email'],
            'type' => 3,
            'password' => Hash::make($contact['data']['info']['password']),
        ]); 
        event(new Registered($user));

        // auth()->login($user);
        $contact['data']['info']['id_user'] = $user['id'];
        $contact['data']['info']['id_carrier'] = Auth::user()->id;

        $client = Driver::updateOrCreate(['id_user' => $contact['data']['info']['id_user']],$contact['data']['info']);
        return $user;
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
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        $model = Driver::find($id);
        return response()->json($model);
    }

    public function list(Driver $Carrier)
    {
        $model = Driver::with(['typeCard'])->where('id_carrier', '=', Auth::user()->id)->get();
        return response()->json($model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data)
    {
        $driver = $data->all();
        $driver['data'] = json_decode($driver['data'],true);

        $driver = Driver::updateOrCreate(['id_user' => $driver['data']['info']['id_user']],$driver['data']['info']);
        return $driver;
    }

    public function activate(Request $id)
    {
        $activate = Driver::where('id', $id['id'])->update(array('active' => $id['active']==1?0:1));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id)
    {
        $deletedUser = User::where('id', $id['id_user'])->delete();
        $deletedClient = Driver::where('id', $id['id'])->delete();
    }
}
