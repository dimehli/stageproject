@extends('layout')

@section('title', 'User Dashboard')

@section('content')
@auth
    <h1>Welcome, {{ Auth::user()->name }}!</h1>
    <p>This is your user dashboard.</p>
    @endauth
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Create New Demand</title>
            <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
            <link href="{{ asset('App\ressources\css\form-styles.css') }}" rel="stylesheet">
            <link href="{{ asset('ressources\css\navbar.css') }}" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="stylesheet" href="css/dashbord_user.css"> 

            
        </head>
        <body>

        <h1>{{ isset($demande) ? 'Edit Demand' : ' Request for Intervention' }}</h1>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        <a href="{{ route('demandes.index') }}">view User Requests</a>
        <form action="{{ route('demande.store') }}" method="post" >
            @csrf
            @if(isset($demande))
                @method('PATCH')
            @endif
            @isset($demande)
                <input type="hidden" name="id" value="{{ $demande->id }}">
            @endisset
            <label for="date_demande">Date of Demand:</label>
            <input type="date" name="date_demande" value="{{ isset($demande) ? $demande->date_demande : '' }}" required><br>

            <label for="nom_demandeur">Name of Requester:</label>
            <input type="text" name="nom_demandeur" value="{{ isset($demande) ? $demande->nom_demandeur : '' }}" required><br>

            <label for="departement">Department:</label>
            <select name="departement" id="departement" required>
                <option value="">Select Department</option>
                <option value="chargé de mission" {{ isset($demande) && $demande->departement === 'chargé de mission' ? 'selected' : '' }}>Chargé de mission</option>
                <option value="division des affaires" {{ isset($demande) && $demande->departement === 'division des affaires' ? 'selected' : '' }}>Division des affaires</option>
                <option value="service informatique" {{ isset($demande) && $demande->departement === 'service informatique' ? 'selected' : '' }}>Service informatique</option>
                <option value="département des études et de la topographie" {{ isset($demande) && $demande->departement === 'département des études et de la topographie' ? 'selected' : '' }}>Département des études et de la topographie</option>
                <option value="département de la question urbaine et de la réglementation" {{ isset($demande) && $demande->departement === 'département de la question urbaine et de la réglementation' ? 'selected' : '' }}>Département de la question urbaine et de la réglementation</option>
            </select><br>

            <label for="signature">Signature:</label>
            <canvas id="signatureCanvas" width="300" height="100" style="border:1px solid #000000;"></canvas>
            <button onclick="clearSignature()">Effacer la signature</button>
            <input type="hidden" name="signatureData" id="signatureData" required><br>
        <script>
            var canvas = document.getElementById("signatureCanvas");
            var ctx = canvas.getContext("2d");
            var isDrawing = false;

            canvas.addEventListener("mousedown", function (e) {
                isDrawing = true;
                ctx.beginPath();
                ctx.moveTo(e.clientX - canvas.offsetLeft, e.clientY - canvas.offsetTop);
            });

            canvas.addEventListener("mousemove", function (e) {
                if (isDrawing) {
                    ctx.lineTo(e.clientX - canvas.offsetLeft, e.clientY - canvas.offsetTop);
                    ctx.stroke();
                }
            });

            canvas.addEventListener("mouseup", function () {
                isDrawing = false;
                updateSignatureInput();
            });

            canvas.addEventListener("mouseout", function () {
                isDrawing = false;
            });

            function clearSignature() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                updateSignatureInput();
            }

            function updateSignatureInput() {
                var signatureData = canvas.toDataURL();
                document.getElementById("signatureData").value = signatureData;
            }
        </script>

    <div class="type">
        <label>Type of Material:</label><br>
        <input type="radio" id="unit_centrale" name="type_materiel" value="unité centrale" {{ isset($demande) && $demande->type_materiel === 'unité centrale' ? 'checked' : '' }}>
        <label class="button" for="unit_centrale">Unité Centrale</label>

        <input type="radio" id="imprimante" name="type_materiel" value="imprimante" {{ isset($demande) && $demande->type_materiel === 'imprimante' ? 'checked' : '' }}>
        <label class="button" for="imprimante">Imprimante</label>

        <input type="radio" id="moniteur" name="type_materiel" value="moniteur" {{ isset($demande) && $demande->type_materiel === 'moniteur' ? 'checked' : '' }}>
        <label class="button" for="moniteur">Moniteur</label>

        <input type="radio" id="logiciel" name="type_materiel" value="logiciel" {{ isset($demande) && $demande->type_materiel === 'logiciel' ? 'checked' : '' }}>
        <label class="button" for="logiciel">Logiciel</label><br>
    </div>
        <label for="probleme_constate">Observed Problem:</label>
        <textarea name="probleme_constate" required>{{ isset($demande) ? $demande->probleme_constate : '' }}</textarea><br>
        
            <button type="submit">{{ isset($demande) ? 'Save Changes' : 'Submit' }}</button>
        </form>
        
        


        </body>
        </html>
@endsection
