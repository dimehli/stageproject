<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Demande;

class DemandeController extends Controller
{
    public function index()
{
    if (Auth::check()) {
        $user = Auth::user();
        $demandes = $user->demandes;
        return view('demandes.index', compact('demandes'));
    }
    return redirect()->route('login');
}


    public function create()
    {
        return view('demandes.index');
    }



    public function store(Request $request)
{
    // Validation des champs de la demande
    $request->validate([
        'date_demande' => 'required|date',
        'nom_demandeur' => 'required|string',
        'departement' => 'required|string',
        'signatureData' => 'required|string',
        'type_materiel' => 'required|string',
        'numero_inventaire' => 'nullable|string',
        'probleme_constate' => 'required|string',
    ]);

    
    $request->merge(['user_id' => Auth::id()]);
    Demande::create($request->all());
    return redirect()->route("demandes.index")->with('success', 'Demande ajoutée avec succès');
}


    public function edit($id)
    {
        $demande = Demande::findOrFail($id);
        return view('user.dashboard', compact('demande'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
        'date_demande' => 'required|date_format:Y-m-d',
        'nom_demandeur' => 'required|string',
        'departement' => 'required|string',
        'signatureData' => 'required|string',
        'type_materiel' => 'required|string',
        'numero_inventaire' => 'nullable|string',
        'probleme_constate' => 'required|string',
        ]);

        $demande = Demande::findOrFail($id);
        $demande->update($request->all());

        return redirect('/demandes')->with('success', 'Demande mise à jour avec succès');
    }

    public function destroy($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->delete();

        return redirect('/demandes')->with('success', 'Demande supprimée avec succès');
    }
}
