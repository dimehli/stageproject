<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des demandes des utilisateurs</title>
    <link rel="stylesheet" href="css/dashbord_admin.css"> <!-- Assurez-vous que le chemin vers votre fichier CSS est correct -->
</head>
<body>
<style>
    /* Reset des styles par défaut */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Style de base pour le corps de la page */
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    padding: 20px;
}

/* Style pour le titre principal */
h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

/* Style pour le paragraphe */
p {
    font-size: 16px;
    margin-bottom: 20px;
}

/* Style pour le tableau */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

/* Style pour les cellules de titre */
th {
    background-color: #333;
    color: #fff;
    padding: 10px;
    text-align: left;
}

/* Style pour les cellules de données */
td {
    padding: 10px;
    border: 1px solid #ddd;
}

/* Style pour les boutons */
button {
    padding: 8px 16px;
    border: none;
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
    margin-right: 10px;
}

button:hover {
    background-color: #0056b3;
}

/* Style pour les messages d'alerte */
.alert {
    padding: 10px;
    margin-bottom: 20px;
    background-color: #28a745;
    color: #fff;
    border-radius: 5px;
}

.alert-success {
    background-color: #28a745;
}

.alert-danger {
    background-color: #dc3545;
}

</style>
    @extends('layout')

    @section('title', 'Admin Dashboard')

    @section('content')

        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        <p>This is your admin dashboard.</p>

        <h1>List of User Requests</h1>
        <table>
            <thead>
                <tr>
                    <th>Name of Requester</th>
                    <th>Date of Demand:</th>
                    <th>Department:</th>
                    <th>Type of Material:</th>
                    <th>Observed Problem:</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($demandesUtilisateurs as $demande)
                    <tr>
                        <td>{{ $demande->nom_demandeur }}</td>
                        <td>{{ $demande->date_demande }}</td>
                        <td>{{ $demande->departement }}</td>
                        <td>{{ $demande->type_materiel }}</td>
                        <td>{{ $demande->probleme_constate }}</td>
                        <td>
                            <input type="hidden" name="id" value="{{ $demande->id }}">
                            <form action="{{ route('admin.process_request.post', $demande->id) }}" method="post">
                                @csrf
                                <button type="submit" name="accept">Accepter</button>
                                <button type="submit" name="reject">Refuser</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
            </tbody>
        </table>

    @endsection

</body>
</html>
