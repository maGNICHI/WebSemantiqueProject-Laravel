<!DOCTYPE html>
<html>
<head>
    <title>Réclamation #{{ $reclamation->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .reclamation-details {
            margin-bottom: 20px;
        }
        .reponse {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Réclamation #{{ $reclamation->id }}</h1>
    </div>

    <div class="reclamation-details">
        <p><strong>Sujet:</strong> {{ $reclamation->sujet }}</p>
        <p><strong>Description:</strong> {{ $reclamation->description }}</p>
        <p><strong>État:</strong> {{ $reclamation->etat }}</p>
    </div>

    <div class="reponses-section">
        <h3>Réponses</h3>
        @if($reclamation->reponses->isEmpty())
            <p>Aucune réponse pour cette réclamation.</p>
        @else
            @foreach($reclamation->reponses as $reponse)
                <div class="reponse">
                    <p><strong>Réponse:</strong> {{ $reponse->message }}</p>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>
