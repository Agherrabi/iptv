<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use Illuminate\Http\Request;

class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listpack=pack::all();
        return view('layouts.pack.index',compact('listpack'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.pack.create');
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
            'label' => 'required',
            'prix' => 'required|numeric',
            'duree' => 'required|numeric',

        ]);
        $pack = new Pack();
        $pack->label=$request->get('label');
        $pack->client_id=$request->get('client_id');
        $pack->date_creation=$request->get('date_creation');
        $pack->date_experation=$request->get('date_experation');
        $pack->status=$request->get('status');
        $pack->forniceur=$request->get('forniceur');
        $pack->serveur=$request->get('serveur');
        $pack->panel=$request->get('panel');
        $pack->username=$request->get('username');
        $pack->period_abonnement=$request->get('period_abonnement');
        $pack->prix=$request->get('prix');
        $pack->avence=$request->get('avence');
        $pack->reste=$request->get('reste');
        $pack->moyen_paiment=$request->get('moyen_paiment');
        $pack->status_paiment=$request->get('status_paiment');
        $pack->m3u=$request->get('m3u');
        $pack->remarque=$request->get('remarque');

        $pack->save();

        return redirect()->back()->with('success','pack est bien ajouté.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pack  $pack
     * @return \Illuminate\Http\Response
     */
    public function show(Pack $pack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pack  $pack
     * @return \Illuminate\Http\Response
     */
    public function edit(Pack $pack)
    {
        return view('layouts.pack.edit',compact('pack'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pack  $pack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updatpack = Pack::find($id);

        $updatpack->label=$request->get('label');
        $updatpack->client_id=$request->get('client_id');
        $updatpack->date_creation=$request->get('date_creation');
        $updatpack->date_experation=$request->get('date_experation');
        $updatpack->status=$request->get('status');
        $updatpack->forniceur=$request->get('forniceur');
        $updatpack->serveur=$request->get('serveur');
        $updatpack->panel=$request->get('panel');
        $updatpack->username=$request->get('username');
        $updatpack->period_abonnement=$request->get('period_abonnement');
        $updatpack->prix=$request->get('prix');
        $updatpack->avence=$request->get('avence');
        $updatpack->reste=$request->get('reste');
        $updatpack->moyen_paiment=$request->get('moyen_paiment');
        $updatpack->status_paiment=$request->get('status_paiment');
        $updatpack->m3u=$request->get('m3u');
        $updatpack->remarque=$request->get('remarque');


        $updatpack->save();
        return redirect('pack')->with('success','pack est bien modifié.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pack  $pack
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pack::findOrFail($id)->delete();
        return redirect()->back()->with('success','le pack est Supprimé avec succès.');
    }
}
