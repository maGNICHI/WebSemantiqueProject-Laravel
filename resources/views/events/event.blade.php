<!DOCTYPE html>
<html>
<head>
    <title>Liste des Events</title>
    <style>
        .background-container {
            background-color: #dfe7f2; 
            margin: 0;
            padding: 0;
            min-height: 100vh; 
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            margin-left:40px;
            margin-top: 12px;
            margin-bottom: 34px;
            background-color: #f9f9f9; 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            padding: 20px; 
            width: calc(33.33% - 20px); 
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
        }

        .card-header {
            margin-bottom: 15px; 
        }

        .card-body {
            margin-bottom: 15px; 
        }

        .card-footer {
            display: flex;
            justify-content: space-between; 
        }

        .btn {
            background-color: #007bff; 
            color: white; 
            padding: 10px 15px; 
            border: none; 
            border-radius: 5px; 
            text-decoration: none; 
            cursor: pointer; 
        }

        .btn:hover {
            background-color: #0056b3; 
        }
    </style>
</head>
<body>
    <div class="background-container">
        @include('nav') {{-- Inclut votre fichier de navigation --}}

        <h1 style="margin-top: 100px; margin-left:73px">Liste des Events</h1>

        @if(session('success'))
            <div>{{ session('success') }}</div>
        @endif

        <div class="card-container">
            @foreach($events as $event)
                <div class="card">
                    <div class="card-body">
                    @if($event->image)
                        <p>
                            <img src="{{ asset('uploads/' . $event->image) }}" class="img-fluid" width="300" alt="Image de l'activité">
                        </p>
                    @endif
                        <p><strong>Nom :</strong> {{ $event->nom }}</p>
                        <p><strong>Description :</strong> {{ $event->description }}</p>
                        <p><strong>Date_Debut :</strong> {{ $event->date_debut }}</p>
                        <p><strong>Date_Fin :</strong> {{ $event->date_fin }}</p>
                        <p><strong>Destination :</strong> {{ $event->destination->nom }}</p>
                        <td>
                    </div>
                    <div class="timeline-footer card-footer">
                </div>
                </div>
            @endforeach
        </div>

        @include('footer') {{-- Inclut votre fichier de pied de page --}}
    </div>
</body>
</html>