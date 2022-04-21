<?php

namespace App\Http\Controllers;

use App\Certification;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CertificationController extends Controller
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

        if ($contact['file_path']['img'] != 'undefined'){
            $file = $contact['file_path']['img'];
            $namefile = time().'-'.$contact['data']['info']['id'].'-'.preg_replace("/[^a-z0-9\_\-\.]/i", "", $contact['file_path']['img']->getClientOriginalName());
            $contact['data']['info']['file_path'] = $namefile;
            Storage::disk('public')->put('carriers/certitications/'.$namefile,\File::get($file));
        }
        $client = Certification::create($contact['data']['info']);
        return $client;
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
     * @param  \App\Certification  $certification
     * @return \Illuminate\Http\Response
     */
    public function show(Certification $certification)
    {
        //
    }

    public function list(Certification $Vehicle)
    {
        $model = Certification::where('id_carrier', '=', Auth::user()->id)->get();
        return response()->json($model);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Certification  $certification
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $data)
    {

        $contact = $data->all();
        $contact['data'] = json_decode($contact['data'],true);

        $client = Certification::updateOrCreate(['id' => $contact['data']['info']['id']],$contact['data']['info']);
        return $client;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Certification  $certification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Certification $certification)
    {
        //
    }
    public function activate(Request $id)
    {
        $activate = Certification::where('id', $id['id'])->update(array('active' => $id['active']==1?0:1));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Certification  $certification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id)
    {
        $user = Certification::find($id['id']);
        if ($user){
            Storage::disk('public')->delete('carriers/certitications/'.$user['file_path']);
        }
        $deletedClient = Certification::where('id', $id['id'])->delete();
    }
}
