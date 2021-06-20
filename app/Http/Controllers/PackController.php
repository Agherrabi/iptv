<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Pack;
use App\Models\User;
use App\Models\Client;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Exports\ClientExport;
use App\Exports\AbmtExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

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

        // $listpack15jours = DB::table('clients')
        // ->join('packs', 'packs.client_id', '=', 'clients.id')
        // ->Where( 'date_experation', '<=', Carbon::now()->addDay(15))
        // ->get();

        DB::table('packs')
        ->Where( 'date_experation', '<', Carbon::now())
        ->update(['status'=>'expiré']);

        // $listpackexpire = DB::table('clients')
        // ->join('packs', 'packs.client_id', '=', 'clients.id')
        // ->Where( 'status', 'LIKE', 'expiré')
        // ->get();

        // $listpacknonpaye = DB::table('clients')
        // ->join('packs', 'packs.client_id', '=', 'clients.id')
        // ->Where( 'status_paiment', 'LIKE', 'p')
        // ->get(); ,'listpack15jours','listpackexpire','listpacknonpaye'

        $listfournisseur=Fournisseur::all();

        return view('layouts.pack.index',compact('listpack','listfournisseur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listclient=Client::all();
        $listfournisseur=Fournisseur::all();
        return view('layouts.pack.create',compact('listclient','listfournisseur'));
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
            'client' => 'required',
            'prix' => 'required|numeric',
            'avence' => 'nullable|numeric',
            'date_creation' => 'date',
            'date_experation' => 'date|after:date_creation',

        ]);
        $date_c = Carbon::parse($request->get('date_creation'));
        $date_e = Carbon::parse($request->get('date_experation'));

        $diff_date = $date_e->diffInDays($date_c);

        if (empty($request->get('avence'))) {
        $avence = 0;
        }else{
            $avence = $request->get('avence');
        }

        $reste = $request->get('prix') - $avence;

        if($reste == $request->get('prix')){
                $satupaiment = 'n';
        }else if($reste == 0){
            $satupaiment = 'p';
        }
        else if($avence > $request->get('prix')){
            $satupaiment = 'p';
        }else if($avence > 0){
            $satupaiment = 'a';
        }else {
            $satupaiment = 'n';
        }

        $paneldetail = DB::table('panels')->where('id',$request->get('panel_id'))->get();
        $fourdetail = DB::table('fournisseurs')->where('id',$request->get('four_id'))->get();

        $pack = new Pack();
        $pack->label=$request->get('label');
        $pack->client_id=$request->get('client');
        $pack->date_creation=$request->get('date_creation');
        $pack->date_experation=$request->get('date_experation');
        $pack->status='active';
        $pack->four_id=$request->get('four_id');
        $pack->forniceur=$fourdetail[0]->nom;
        $pack->panel_id=$request->get('panel_id');
        $pack->panel=$paneldetail[0]->nom;
        $pack->serveur=$paneldetail[0]->serveur;
        $pack->username=$paneldetail[0]->username;
        $pack->period_abonnement=$diff_date;
        $pack->prix=$request->get('prix');
        $pack->avence=$avence;
        $pack->reste=$reste;
        $pack->moyen_paiment=$request->get('moyen_paiment');
        $pack->status_paiment=$satupaiment;
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
        $listclient=Client::all();
        $listfournisseur=Fournisseur::all();
        return view('layouts.pack.edit',compact('pack','listclient','listclient','listfournisseur'));
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
        //     $satupaiment = 'non payé';
        // }else if($reste == 0){
        //     $satupaiment = 'p';
        // }else if($avence > 0){
        //     $satupaiment = 'a';
        // }else {
        //     $satupaiment = 'n';
        // }

        $paneldetail = DB::table('panels')->where('id',$request->get('panel_id'))->get();
        $fourdetail = DB::table('fournisseurs')->where('id',$request->get('four_id'))->get();

        $pack = Pack::find($id);

        $pack->label=$request->get('label');
        $pack->client_id=$request->get('client');
        $pack->date_creation=$request->get('date_creation');
        $pack->date_experation=$request->get('date_experation');
        $pack->status=$request->get('status');

        $pack->four_id=$request->get('four_id');
        $pack->forniceur=$fourdetail[0]->nom;
        $pack->panel_id=$request->get('panel_id');
        $pack->panel=$paneldetail[0]->nom;
        $pack->serveur=$paneldetail[0]->serveur;
        $pack->username=$paneldetail[0]->username;

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
        Pack::find($id)->delete();

        $listpack = DB::table('clients')
        ->join('packs', 'packs.client_id', '=', 'clients.id')
        ->get();

        // $listpack15jours = DB::table('clients')
        // ->join('packs', 'packs.client_id', '=', 'clients.id')
        // ->Where( 'date_experation', '<=', Carbon::now()->addDay(15))
        // ->get();

        // $listpackexpire = DB::table('clients')
        // ->join('packs', 'packs.client_id', '=', 'clients.id')
        // ->Where( 'status', 'LIKE', 'expiré')
        // ->get();

        // $listpacknonpaye = DB::table('clients')
        // ->join('packs', 'packs.client_id', '=', 'clients.id')
        // ->Where( 'status_paiment', 'LIKE', 'p')
        // ->get();  ,'listpack15jours','listpackexpire','listpacknonpaye'



        return view('layouts.pack.index',compact('listpack'))->with('success','Supprimé avec succès.');
        //return redirect()->back();
    }

    public function recherch(Request $request)
    {

        if($request->has('abmtExport')) {

            return Excel::download(new AbmtExport($request->input('nom'),$request->input('abonnement'),$request->input('status'),$request->input('statusP'),$request->input('date_d'),$request->input('date_f')), 'abmt.xlsx');
        }
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
        if (isset($input['date_d']) && $input['date_d'])
        $query=$query->whereBetween('date_experation',[$input['date_d'],$input['date_f']]);
        $listpack =$query->get();




        $listpack15jours = DB::table('clients')
        ->join('packs', 'packs.client_id', '=', 'clients.id')
        ->Where( 'date_experation', '<=', Carbon::now()->addDay(15))
        ->get();


        $listpackexpire = DB::table('clients')
        ->join('packs', 'packs.client_id', '=', 'clients.id')
        ->Where( 'status', 'LIKE', 'expiré')
        ->get();

        $listpacknonpaye = DB::table('clients')
        ->join('packs', 'packs.client_id', '=', 'clients.id')
        ->Where( 'status_paiment', 'LIKE', 'p')
        ->get();

        $nom = $input['nom'];
        $abonnement = $input['abonnement'];
        $status = $input['status'];
        $statusP = $input['statusP'];

        return view('layouts.pack.index',compact('listpack','listpack15jours','listpackexpire','listpacknonpaye','nom','abonnement','status','statusP'));

    }
    public function reste15j()
    {

       $listpack15jours = DB::table('clients')
        ->join('packs', 'packs.client_id', '=', 'clients.id')
        ->Where( 'date_experation', '<=', Carbon::now()->addDay(15))
        ->get();

        return view('layouts.pack.reste15',compact('listpack15jours'));
    }


    public function userindex()
    {
       $listuser =  User::all();
        return view('layouts.user.index',compact('listuser'));
    }

    public function userajouter()
    {

        return view('layouts.user.create');
    }

    public function userstore(Request $request)
    {

        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);

        $user = new User();
        $user->name=$request->get('nom');
        $user->email=$request->get('email');
        $user->password=Hash::make($request->get('password'));
        $user->is_admin =$request->get('is_admin');
        $user->save();
        return redirect()->back()->with('success','bien ajouté.');
    }

    public function useredit($id)
    {
            $user = User::findOrFail($id);
            return view('layouts.user.edit',compact('user'));

    }
    public function userupdate(Request $request)
    {
        $user = User::findOrFail($request->id);

        if($request->get('password')){
            $request->validate([
                'nom' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],

            ]);
            $user->name=$request->get('nom');
            $user->email=$request->get('email');
            $user->password=Hash::make($request->get('password'));
            $user->is_admin =$request->get('is_admin');
            $user->save();
            return  redirect()->back()->with('success','bien edité.');
        }else{
            $request->validate([
                'nom' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],

        ]);
        $user->name=$request->get('nom');
        $user->email=$request->get('email');
        $user->is_admin =$request->get('is_admin');

        $user->save();
        return  redirect()->back()->with('success','bien edité.');

    }
}


    public function userdelete($id){
        if($id == 1){
            return redirect()->back()->with('error','vous ne pouvez pas supprimer cet administrateur.');
        }else{
            User::findOrFail($id)->delete();
            return redirect()->back()->with('success','le pack est Supprimé avec succès.');
        }
    }


    public function clientexport()
    {
        return Excel::download(new ClientExport, 'cliens.xlsx');
    }

    public function abmtexport(Request $request)
    {
        $status =   $request->input('status');
        return Excel::download(new AbmtExport($status), 'abmt.xlsx');

    }






}

