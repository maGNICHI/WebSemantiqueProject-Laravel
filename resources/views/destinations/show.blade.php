<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    flex-direction: column;
    align-items: center;
    gap: 20px;
    padding: 20px;
}

.card-header {
    margin-bottom: 15px; /* Espacement entre le titre et le corps */
}

.card-body {
    margin-bottom: 15px; /* Espacement entre le corps et le pied de page */
}

.card-footer {
    display: flex;
    justify-content: space-between; /* Espacement entre les boutons */
}

.timeline-body {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    width: 100%;
    max-width: 600px; /* Ajustement de la largeur */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.timeline-body:hover {
    transform: scale(1.02); /* Légère animation de zoom au survol */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.timeline-header {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.timeline-header .userimage img {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    margin-right: 10px;
}

.username {
    font-weight: bold;
    font-size: 16px;
}

.text-muted {
    font-size: 12px;
    color: #999;
    margin-left: auto;
}

.timeline-content h4 {
    font-size: 18px;
    margin-bottom: 10px;
}

.timeline-content p {
    color: #555;
    margin-top: 10px;
}

.timeline-footer {
    display: flex;
    justify-content: flex-end;
    margin-top: 10px;
}

.timeline-footer .btn {
    background-color: #007bff;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.timeline-footer .btn:hover {
    background-color: #0056b3;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    border: 1px solid #c3e6cb;
    text-align: center;
}

.return-button {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    margin-top: 20px;
    transition: background-color 0.3s ease;
}

.return-button:hover {
    background-color: #0056b3;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="background-container">

    <h1 class="text-center my-5">Détails de Destination</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card-container">
        <h2>Détails de Destination</h2>
        <div class="timeline-body">
            <div class="timeline-header">
                <span class="userimage">
                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="Avatar" class="user-avatar">
                </span>
                <span class="username">{{ Auth::user()->name }}</span>
                <span class="text-muted">Créé le: {{ $destination->created_at->format('d/m/Y') }}</span>
            </div>
            <div class="timeline-content">
                <h4>{{ $destination->nom }}</h4>
                <p>{{ $destination->description }}</p>
                <p>{{ $destination->adresse }}</p>
            </div>
        </div>
        
        <div class="timeline-likes">
            <div class="stats-right">
                <span class="stats-text">{{ $destination->events()->count() }} Events</span>
            </div>
        </div>
        <h3>Événements Associés</h3>
        <div class="card-container">
            @if($destination->events->isEmpty())
                <p>Aucun événement associé à cette destination.</p>
            @else
                @foreach($destination->events as $event)
                    <div class="card">
                        <div class="card-body">
                            @if($event->image)
                                <p>
                                    <img src="{{ asset('uploads/' . $event->image) }}" class="img-fluid" width="300" alt="Image de l'activité">
                                </p>
                            @endif
                            <p><strong>Nom :</strong> {{ $event->nom }}</p>
                            <p><strong>Description :</strong> {{ $event->description }}</p>
                            <p><strong>Date Début :</strong> {{ $event->date_debut }}</p>
                            <p><strong>Date Fin :</strong> {{ $event->date_fin }}</p>
                            <p><strong>Destination :</strong> {{ $event->destination->nom }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <!-- Bouton de retour à la page des destinations -->
        <a href="{{ route('destinations.destination') }}" class="return-button">Retour à la page des destinations</a>
        
    </div>
</div>

</body>
</html>
