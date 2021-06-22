<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\Panel;
use App\Exports\panelExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//         $panel = DB::table('four_panel')
//             ->join('panels', 'four_panel.panel_id', '=', 'panels.id')
//             ->select('panels.*')
//             ->where('panels.id',1)
//             ->get();

// return $panel;

        $listpanel=Panel::all();

        return view('layouts.panel.index',compact('listpanel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listpack = Pack::all();
        return view('layouts.panel.create',compact('listpack'));
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
        $panel = new Panel();
        $panel->nom=$request->get('nom');
        $panel->serveur=$request->get('serveur');
        $panel->username=$request->get('username');
        $panel->date_d=$request->get('date_d');
        $panel->date_d=$request->get('date_f');
        $panel->qtte=$request->get('qtte');

        $panel->save();

        return redirect()->back()->with('success','Bien ajouté.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function show(Panel $panel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function edit(Panel $panel)
    {
        return view('layouts.panel.edit',compact('panel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updatpanel = Panel::find($id);

        $updatpanel->nom=$request->get('nom');
        $updatpanel->serveur=$request->get('serveur');
        $updatpanel->username=$request->get('username');
        $updatpanel->date_d=$request->get('date_d');
        $updatpanel->date_d=$request->get('date_f');
        $updatpanel->qtte=$request->get('qtte');

        $updatpanel->save();

        DB::table('packs')->where('panel_id',$id)->update(['serveur' => $request->get('serveur'),'username' => $request->get('username')]);
        return redirect('panel')->with('success','panel est bien modifié.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Panel::findOrFail($id)->delete();
        return redirect()->back()->with('success','Supprimé avec succès.');
    }

    public function getpanel(Request $request)
    {
        $id=$request->id;

        $panel = DB::table('four_panel')
            ->join('panels', 'four_panel.panel_id', '=', 'panels.id')
            ->select('panels.*')
            ->where('four_panel.fournisseur_id',$id)
            ->distinct('panels.nom')
            ->get();

        // Fetch all records
        $decharges['data'] = $panel;

        return json_encode($decharges);
    }


    public function panelexport()
    {
        return Excel::download(new panelExport, 'panel.xlsx');
    }
}
