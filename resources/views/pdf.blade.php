<!DOCTYPE html>
<html>
<head>
    <title>Détails du Transport</title>
    <style>
        /* Ajoutez ici les styles personnalisés pour le PDF */
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
        .card {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
        }
        .card-footer {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Détails du Transport</h1>
        <p><strong>Type :</strong> {{ $transport->type }}</p>
        <p><strong>Description :</strong> {{ $transport->description }}</p>
        <p><strong>Capacité :</strong> {{ $transport->capacite }}</p>
        @if($transport->itineraire)
            <p><strong>Itinéraire :</strong> {{ $transport->itineraire->nom }}</p>
        @else
            <p><strong>Itinéraire :</strong> Aucun itinéraire associé</p>
        @endif
    </div>
</body>
</html>
