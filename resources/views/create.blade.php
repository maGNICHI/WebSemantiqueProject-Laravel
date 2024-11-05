@extends('dashboard')

@section('content')
    <style>
        form {
            max-width: 600px; /* Limiter la largeur du formulaire */
            margin: 20px auto; /* Centrer le formulaire sur la page */
            padding: 20px; /* Espacement interne */
            border: 1px solid #ccc; /* Bordure légère */
            border-radius: 5px; /* Coins arrondis */
            background-color: #f9f9f9; /* Couleur de fond */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Ombre légère */
        }

        h1 {
            text-align: center; /* Centrer le titre */
            color: #333; /* Couleur du texte */
        }

        div {
            margin-bottom: 15px; /* Espacement entre les champs */
        }

        label {
            display: block; /* Les étiquettes prennent toute la largeur */
            margin-bottom: 5px; /* Espacement entre l'étiquette et le champ */
            font-weight: bold; /* Gras pour l'étiquette */
        }

        input[type="text"],
        textarea {
            width: 100%; /* Prendre toute la largeur du conteneur */
            padding: 10px; /* Espacement interne */
            border: 1px solid #ccc; /* Bordure légère */
            border-radius: 5px; /* Coins arrondis */
        }

        input.error, textarea.error {
            border: 2px solid red; /* Bords rouges pour les erreurs */
        }

        .error-message {
            color: red; /* Couleur du texte des erreurs */
            font-size: 12px;
        }

        button {
            background-color: #007bff; /* Couleur de fond du bouton */
            color: white; /* Couleur du texte */
            border: none; /* Pas de bordure */
            border-radius: 5px; /* Coins arrondis */
            padding: 10px 15px; /* Espacement interne du bouton */
            cursor: pointer; /* Curseur de main */
            transition: background-color 0.3s; /* Effet de transition */
        }

        button:hover {
            background-color: #0056b3; /* Couleur du bouton au survol */
        }

        .btn-retour {
            display: inline-block; /* Le rendre similaire à un bouton */
            background-color: #007bff; /* Couleur de fond */
            color: white; /* Couleur du texte */
            border: none; /* Pas de bordure */
            border-radius: 5px; /* Coins arrondis */
            padding: 10px 15px; /* Espacement interne */
            text-align: center; /* Centrer le texte */
            text-decoration: none; /* Retirer le soulignement du lien */
            cursor: pointer; /* Curseur en forme de main */
            transition: background-color 0.3s; /* Effet de transition */
        }

        .btn-retour:hover {
            background-color: #0056b3; /* Couleur au survol */
        }
    </style>

    <h1>Ajouter un Itinéraire</h1>

    <form id="itineraireForm" action="{{ route('itineraires.store') }}" method="POST">
        @csrf
        <div>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
            <div class="error-message" id="error-nom"></div> <!-- Message d'erreur pour le champ nom -->
        </div>

        <div>
            <label for="description">Description :</label>
            <textarea id="description" name="description" required></textarea>
            <div class="error-message" id="error-description"></div> <!-- Message d'erreur pour la description -->
        </div>

        <div>
            <label for="duree">Durée :</label>
            <input type="text" id="duree" name="duree" required>
            <div class="error-message" id="error-duree"></div> <!-- Message d'erreur pour la durée -->
        </div>
        <div>
        <div class="form-group">
            <label for="destination_id">Destination</label> <!-- Nouveau champ "destination_id" -->
            <select name="destination_id" id="destination_id" class="form-control" required>
                <option value="">Sélectionnez une destination</option>
                @foreach ($destinations as $destination)
                    <option value="{{ $destination->id }}" {{ old('destination_id') == $destination->id ? 'selected' : '' }}>
                        {{ $destination->nom }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
        <button type="submit">Ajouter</button>
        <a href="{{ route('itineraires.index') }}" class="btn-retour">Retour</a>
    </form>

   
@endsection
