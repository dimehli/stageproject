
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Demands</title>
    <link rel="stylesheet" href="css/index.css"> 

</head>

<body>
@extends('layout')
@section('title', 'Login')
@section('content')
<style>
    /* Reset des styles par défaut */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Style pour le titre principal */
h1 {
    font-size: 24px;
    margin-bottom: 20px;
    text-align: center;
}

/* Style pour le paragraphe */
p {
    font-size: 16px;
    margin-bottom: 20px;
}

/* Style pour la liste des demandes */
ul {
    list-style: none;
    padding: 0;
}

/* Style pour chaque élément de la liste */
li {
    margin-bottom: 20px;
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
}

/* Style pour les liens d'édition */
a {
    margin-right: 10px;
    text-decoration: none;
    color: #007bff;
}

a:hover {
    text-decoration: underline;
}

/* Style pour les boutons de suppression */
button {
    padding: 5px 10px;
    background-color: #dc3545;
    border: none;
    color: #fff;
    cursor: pointer;
}

button:hover {
    background-color: #c82333;
}

</style>
<h1>List of Demands</h1>

@if(session('message'))
    <p>{{ session('message') }}</p>
@endif


@if(count($demandes) > 0)
    <ul>
    @foreach($demandes as $demande)
            <li>
                {{ $demande->nom_demandeur }} - {{ $demande->date_demande }} - {{ $demande->departement }}   - {{ $demande->emargement }} - {{ $demande->type_materiel }} - {{ $demande->numero_inventaire }} - {{ $demande->probleme_constate }}

               
                <a href="{{ url('/demandes/' . $demande->id . '/edit') }}">Edit</a>

                
                <form id="deleteForm{{ $demande->id }}" action="{{ url('/demandes/' . $demande->id) }}" method="post" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmAndSubmit({{ $demande->id }})">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@else
    <p>No demands found.</p>
@endif



<script>
    function confirmAndSubmit(demandeId) {
        if(confirm('Are you sure you want to delete this demand?')) {
            document.getElementById('deleteForm' + demandeId).submit();
        }
    }
</script>

</body>
</html>
@endsection
