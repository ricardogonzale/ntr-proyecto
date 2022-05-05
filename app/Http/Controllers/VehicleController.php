<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VehicleController extends Controller
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
    public function create(Request $data)
    {
        $contact = $data->all();
        $contact['data'] = json_decode($contact['data'],true);
        $contact['data']['info']['id_carrier'] = Auth::user()->id;
        $vehicle = Vehicle::create($contact['data']['info']);
        return $vehicle;
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
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    public function list(Vehicle $Vehicle)
    {
        $model = Vehicle::with('typeVehicle')->where('id_carrier', '=', Auth::user()->id)->get();
        return response()->json($model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $vehicle)
    {
        $driver = $vehicle->all();
        $driver['data'] = json_decode($driver['data'],true);
        $driver = Vehicle::updateOrCreate(['id' => $driver['data']['info']['id']],$driver['data']['info']);
        return $driver;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function activate(Request $id)
    {
        $activate = Vehicle::where('id', $id['id'])->update(array('active' => $id['active']==1?0:1));
    }

    public function destroy(Request $id)
    {
        $deletedClient = Vehicle::where('id', $id['id'])->delete();
    }
}
