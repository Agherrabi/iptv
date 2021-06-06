<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pack;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listpack = DB::table('clients')
        ->join('packs', 'packs.client_id', '=', 'clients.id')
        ->get();

        return view('layouts.pack.index',compact('listpack'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listclient=Client::all();
        return view('layouts.pack.create',compact('listclient'));
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
            'prix' => 'required|numeric',
            'avence' => 'numeric',
            'date_creation' => 'date',
            'date_experation' => 'date|after:date_creation',

        ]);
        $date_c = Carbon::parse($request->get('date_creation'));
        $date_e = Carbon::parse($request->get('date_experation'));

        $diff_date = $date_e->diffInDays($date_c);

        if($request->get('avence')==null)
        $avence=0;
        else
        $avence=$request->get('avence');

        $reste = $request->get('prix') - $avence;

        // if($reste == $request->get('prix')){
        //         $satupaiment = 'non payé';
        // }else if($reste == 0){
        //     $satupaiment = 'payé'
        // }else if($avence > 0){
        //     $satupaiment = 'avence'
        // }else {
        //     $satupaiment = 'non payé';
        // }



        $pack = new Pack();
        $pack->label=$request->get('label');
        $pack->client_id=$request->get('client');
        $pack->date_creation=$request->get('date_creation');
        $pack->date_experation=$request->get('date_experation');
        $pack->status=$request->get('status');
        $pack->forniceur=$request->get('forniceur');
        $pack->serveur=$request->get('serveur');
        $pack->panel=$request->get('panel');
        $pack->username=$request->get('username');
        $pack->period_abonnement=$diff_date;
        $pack->prix=$request->get('prix');
        $pack->avence=$avence;
        $pack->reste=$reste;
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
        $listclient=Client::all();
        return view('layouts.pack.edit',compact('pack','listclient'));
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
        $request->validate([
            'prix' => 'required|numeric',
            'avence' => 'numeric',
            'date_creation' => 'date',
            'date_experation' => 'date|after:date_creation',

        ]);
        $date_c = Carbon::parse($request->get('date_creation'));
        $date_e = Carbon::parse($request->get('date_experation'));

        $diff_date = $date_e->diffInDays($date_c);

        if($request->get('avence')==null)
        $avence=0;
        else
        $avence=$request->get('avence');

        $reste = $request->get('prix') - $avence;

        // if($reste == $request->get('prix')){
        //         $satupaiment = 'non payé';
        // }else if($reste == 0){
        //     $satupaiment = 'payé'
        // }else if($avence > 0){
        //     $satupaiment = 'avence'
        // }else {
        //     $satupaiment = 'non payé';
        // }

        $pack = new Pack();
        $pack->label=$request->get('label');
        $pack->client_id=$request->get('client');
        $pack->date_creation=$request->get('date_creation');
        $pack->date_experation=$request->get('date_experation');
        $pack->status=$request->get('status');
        $pack->forniceur=$request->get('forniceur');
        $pack->serveur=$request->get('serveur');
        $pack->panel=$request->get('panel');
        $pack->username=$request->get('username');
        $pack->period_abonnement=$diff_date;
        $pack->prix=$request->get('prix');
        $pack->avence=$avence;
        $pack->reste=$reste;
        $pack->moyen_paiment=$request->get('moyen_paiment');
        $pack->status_paiment=$request->get('status_paiment');
        $pack->m3u=$request->get('m3u');
        $pack->remarque=$request->get('remarque');


        $pack->save();
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

    public function recherch(Request $request)
    {
        $input = $request;
        $query = DB::table('clients')
        ->join('packs', 'packs.client_id', '=', 'clients.id');

        if (isset($input['nom']) && $input['nom'])
        $query=$query->where('nom', 'LIKE', $input['nom']);
        if (isset($input['abonnement'])&& $input['abonnement'])
        $query=$query->where('abonnement', 'LIKE', $input['abonnement']);
        if (isset($input['status']) && $input['status'])
        $query=$query->where('status', 'LIKE', $input['status']);
        if (isset($input['statusP']) && $input['statusP'])
        $query=$query->where('status_paiment', '=', $input['statusP']);

        $listpack =$query->get();
        return view('layouts.pack.index',compact('listpack'));
    }
}

