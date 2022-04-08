<?php

namespace App\Http\Controllers;

use App\TypeAvailability;
use Illuminate\Http\Request;

class TypeAvailabilityController extends Controller
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
     * @param  \App\TypeAvailability  $typeAvailability
     * @return \Illuminate\Http\Response
     */
    public function show(TypeAvailability $typeAvailability)
    {
        //
    }

    public function list()
    {
        $model = TypeAvailability::all();
        return response()->json($model);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeAvailability  $typeAvailability
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeAvailability $typeAvailability)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeAvailability  $typeAvailability
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeAvailability $typeAvailability)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeAvailability  $typeAvailability
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeAvailability $typeAvailability)
    {
        //
    }
}
