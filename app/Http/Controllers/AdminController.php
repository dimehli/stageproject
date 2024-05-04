<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Session;
use App\Models\Demande;

class AdminController extends Controller
{
    public function admin()
{
    $demandesUtilisateurs = $this->userRequests();

        // Charger la vue avec les données des demandes des utilisateurs
        return view('admin.dashboard', compact('demandesUtilisateurs'));
}
public function userRequests()
    {
        // Assurez-vous que cette méthode retourne un tableau ou un objet
        $demandesUtilisateurs = Demande::all();
        return $demandesUtilisateurs;
    }
public function processRequest(Request $request, $id)
{

    $demande = Demande::findOrFail($id);

    if ($request->has('accept')) {
        // Traitement pour accepter la demande
        Session::flash('success', 'La demande a été acceptée ');
    } elseif ($request->has('reject')) {
        // Traitement pour refuser la demande
        Session::flash('success', 'La demande a été refusée ');
    }

    return redirect()->back();
}


public function save(Request $request)
    {
        $admin = new Admin();
        $admin->date_intervention = $request->date_intervention;
        $admin->heure_intervention = $request->heure_intervention;
        $admin->action_realisees = $request->action_realisees;
        $admin->date_fin_intervention = $request->date_fin_intervention;
        $admin->heure_fin_intervention = $request->heure_fin_intervention;
        $admin->probleme_resolu = $request->has('probleme_resolu') ? 'oui' : 'non';
        $admin->save();

        // Définir le message de succès dans la session
        $message = $request->probleme_resolu === 'oui' ? 'Le problème a été résolu.' : 'Le problème n\'a pas été résolu.';
        Session::flash('success', $message);

        // Rediriger l'utilisateur vers la page index
        return redirect()->route('admin.dashboard');
    }
    public function demandes()
    {
        $demandes = Demande::all(); // ou une logique pour récupérer les demandes des utilisateurs
        return view('demandes.index', compact('demandes'));
    }
    
}
