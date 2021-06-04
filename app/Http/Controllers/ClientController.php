<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listclient=Client::all();

        return view('layouts.client.index',compact('listclient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listpack = Pack::all();
        return view('layouts.client.create',compact('listpack'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nom' => 'required',
            'abonnement' => 'required|numeric',

        ]);
        $client = new Client();
        $client->nom=$request->get('nom');
        $client->prenom=$request->get('prenom');
        $client->abonnement=$request->get('abonnement');
        $client->paye=$request->get('paye');
        $client->ville=$request->get('ville');
        $client->tel=$request->get('tel');
        $client->adress_mac=$request->get('adress_mac');

        $client->save();

        return redirect()->back()->with('success','Le client est bien ajouté.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('layouts.client.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updatclient = Client::find($id);

        $updatclient->nom=$request->get('nom');
        $updatclient->prenom=$request->get('prenom');
        $updatclient->abonnement=$request->get('abonnement');
        $updatclient->paye=$request->get('paye');
        $updatclient->ville=$request->get('ville');
        $updatclient->tel=$request->get('tel');
        $updatclient->adress_mac=$request->get('adress_mac');

        $updatclient->save();
        return redirect('client')->with('success','client est bien modifié.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::findOrFail($id)->delete();
        return redirect()->back()->with('success','le client est Supprimé avec succès.');
    }
}
