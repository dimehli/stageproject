<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/Home.css"> 

</head>
<body>
    


@extends('layout')

@section('title', 'Home')

@section('content')
<div class="mt-5" style="background-image: url('{{ asset('images/Agence.png') }}'); background-size: cover; background-position: center;">
    <div class="row">
        
    <div class="col-md-6">
    <p>This is the home page. Feel free to explore our site.</p>
    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
</div>
    </div>
</div>

    <div class="mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('images/wakala.jpg') }}" alt="Welcome Image" class="img-fluid">
                <p>
The urban agency operates in several essential domains,
 including studies, urban management, monitoring, 
 and technical assistance. These activities cover a ide range of interventions aimed at improving the
  quality of life in urban areas. Moreover, urban agencies 
  play a crucial role in regional development by enhancing 
  their expertise in urban planning. They act as a lever to
   promote the development of urban agglomerations and improve 
   urban management. Additionally, they contribute to the 
   revitalization of social housing and actively participate
    in integrated regional development. With this perspective
    , urban agencies pursue a concerted approach to address
     urban planning issues. They seek to establish a consensus
      on the diagnosis of urban problems and propose innovative
       solutions within a participatory framework, thereby promoting inclusive and sustainable urban management.</p>
                
                <a href="{{ route('registration') }}" class="btn btn-success">Register Now</a>
            </div>
        </div>
    </div>
@endsection

</body>
</html>