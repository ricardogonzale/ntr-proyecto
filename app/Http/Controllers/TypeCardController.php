<?php

namespace App\Http\Controllers;

use App\TypeCard;
use Illuminate\Http\Request;

class TypeCardController extends Controller
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
     * @param  \App\TypeCard  $typeCard
     * @return \Illuminate\Http\Response
     */
    public function show(TypeCard $typeCard)
    {
        //
    }

    public function list()
    {
        $model = TypeCard::all();
        return response()->json($model);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeCard  $typeCard
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeCard $typeCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeCard  $typeCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeCard $typeCard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeCard  $typeCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeCard $typeCard)
    {
        //
    }
}
