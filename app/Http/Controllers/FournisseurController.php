<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\Panel;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listfournisseur=Fournisseur::all();

        return view('layouts.fournisseur.index',compact('listfournisseur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listpanel = Panel::all();
        return view('layouts.fournisseur.create',compact('listpanel'));
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

        ]);
        $fournisseur = new Fournisseur();
        $fournisseur->nom=$request->get('nom');
        $fournisseur->paye=$request->get('paye');
        $fournisseur->ville=$request->get('ville');
        $fournisseur->tel=$request->get('tel');

        $fournisseur->save();

        if($request->panel){
        for ($i=0; $i < count($request->panel) ; $i++){
                DB::table('four_panel')->insert(['fournisseur_id' =>$fournisseur->id,'panel_id'=>$request->panel[$i]]);
            }
        }
        return redirect()->back()->with('success','Le fournisseur est bien ajouté.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        $listpanel = Panel::all();
        $four_panels = DB::table('four_panel')->where('fournisseur_id',$fournisseur->id)->get();
        return view('layouts.fournisseur.edit',compact('fournisseur','listpanel','four_panels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $updatfournisseur = Fournisseur::find($id);

        $updatfournisseur->nom=$request->get('nom');
        $updatfournisseur->paye=$request->get('paye');
        $updatfournisseur->ville=$request->get('ville');
        $updatfournisseur->tel=$request->get('tel');

        $updatfournisseur->save();

        if($request->panel){
            DB::table('four_panel')->where('fournisseur_id',$id)->delete();
            for ($i=0; $i < count($request->panel) ; $i++){
                    DB::table('four_panel')->insert(['fournisseur_id' =>$id,'panel_id'=>$request->panel[$i]]);
                }
            }
        return redirect('fournisseur')->with('success','fournisseur est bien modifié.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Fournisseur::findOrFail($id)->delete();
        return redirect()->back()->with('success','le fournisseur est Supprimé avec succès.');
    }
}
