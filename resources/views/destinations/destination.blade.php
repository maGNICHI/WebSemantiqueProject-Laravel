<!DOCTYPE html>
<html>
<head>
    <title>Liste des Destinations</title>
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
            margin-left: 40px;
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

        /* Style pour la carte */
        .map-container {
            height: 200px;
            width: 100%;
        }
    </style>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_mQNmvETlfEjmLs7_K-qXo-iUt92w6Iw"></script>
    <script>
        function initMap(lat, lng, elementId) {
            var map = new google.maps.Map(document.getElementById(elementId), {
                center: {lat: lat, lng: lng},
                zoom: 12
            });

            var marker = new google.maps.Marker({
                position: {lat: lat, lng: lng},
                map: map
            });
        }
    </script>
</head>
<body>
    <div class="background-container">
        @include('nav') {{-- Inclut votre fichier de navigation --}}

        <h1 style="margin-top: 100px; margin-left:73px">Liste des Destinations</h1>

        @if(session('success'))
            <div>{{ session('success') }}</div>
        @endif

        <div class="card-container">
            @foreach($destinations as $destination)
                <div class="card">
                    <div class="card-body">
                        <p><strong>Nom :</strong> {{ $destination->nom }}</p>
                        <p><strong>Description :</strong> {{ $destination->description }}</p>
                        <p><strong>Adresse :</strong> {{ $destination->adresse }}</p>
                        <!-- <p><strong>Latitude :</strong> {{ $destination->latitude }}</p>
                        <p><strong>Longitude :</strong> {{ $destination->longitude }}</p> -->

                        <!-- Conteneur pour la carte -->
                        <div id="map-{{ $destination->id }}" class="map-container"></div>
                    </div>
                    <div class="timeline-footer card-footer">
                        <a href="{{ route('destinations.show', $destination->id) }}" class="btn btn-primary">Voir plus</a>
                    </div>
                </div>

                <!-- Initialiser la carte avec les coordonnées de la destination -->
                <script>
                    initMap({{ $destination->latitude }}, {{ $destination->longitude }}, 'map-{{ $destination->id }}');
                </script>
            @endforeach
        </div>

        @include('footer') {{-- Inclut votre fichier de pied de page --}}
    </div>
</body>
</html>
