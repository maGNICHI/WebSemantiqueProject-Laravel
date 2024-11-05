@extends('dashboard')

@section('content')
    <style>
        /* Form Styles */
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
        textarea,
        select {
            width: 100%; /* Prendre toute la largeur du conteneur */
            padding: 10px; /* Espacement interne */
            border: 1px solid #ccc; /* Bordure légère */
            border-radius: 5px; /* Coins arrondis */
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

        .error {
            color: red; /* Couleur pour les messages d'erreur */
            margin-top: 5px; /* Espacement en haut du message d'erreur */
        }
    </style>

    <h1>Ajouter un Certificat</h1>

    <form action="{{ route('certificats.store') }}" method="POST">
        @csrf
        
        <div>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required value="{{ old('nom') }}">
            @error('nom')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="description">Description :</label>
            <textarea id="description" name="description" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="organisme_emetteur">Organisme Émetteur :</label>
            <input type="text" id="organisme_emetteur" name="organisme_emetteur" required value="{{ old('organisme_emetteur') }}">
            @error('organisme_emetteur')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="date_attribution">Date d'Attribution :</label>
            <input type="date" id="date_attribution" name="date_attribution" required value="{{ old('date_attribution') }}">
            @error('date_attribution')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="date_expiration">Date d'Expiration :</label>
            <input type="date" id="date_expiration" name="date_expiration" required value="{{ old('date_expiration') }}">
            @error('date_expiration')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="partenaire_id">Partenaire :</label>
            <select id="partenaire_id" name="partenaire_id" required>
                <option value="" disabled {{ old('partenaire_id') ? '' : 'selected' }}>Sélectionnez un partenaire</option>
                @foreach ($partenaires as $partenaire)
                    <option value="{{ $partenaire->id }}" {{ old('partenaire_id') == $partenaire->id ? 'selected' : '' }}>
                        {{ $partenaire->nom }}
                    </option>
                @endforeach
            </select>
            @error('partenaire_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Ajouter</button>
        <a href="{{ route('certificats.index') }}" class="btn-retour">Retour</a>
    </form>
@endsection
