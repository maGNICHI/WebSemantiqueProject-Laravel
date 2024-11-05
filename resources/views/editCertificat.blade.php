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
        input[type="date"],
        textarea,
        select {
            width: 100%; /* Prendre toute la largeur du conteneur */
            padding: 10px; /* Espacement interne */
            border: 1px solid #ccc; /* Bordure légère */
            border-radius: 5px; /* Coins arrondis */
        }

        button,
        .btn-retour {
            display: inline-block; /* Style bouton pour le lien */
            background-color: #007bff; /* Couleur de fond */
            color: white; /* Couleur du texte */
            border: none; /* Pas de bordure */
            border-radius: 5px; /* Coins arrondis */
            padding: 10px 15px; /* Espacement interne du bouton */
            cursor: pointer; /* Curseur de main */
            text-decoration: none; /* Enlever le soulignement pour le lien */
            transition: background-color 0.3s; /* Effet de transition */
        }

        button:hover,
        .btn-retour:hover {
            background-color: #0056b3; /* Couleur au survol */
        }

        .alert {
            color: red; /* Couleur des erreurs */
            margin: 15px 0; /* Espacement */
            font-weight: bold; /* Gras */
        }
    </style>

    <h1>Modifier un Certificat</h1>

    @if ($errors->any())
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('certificats.update', $certificat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom', $certificat->nom) }}" required>
        </div>

        <div>
            <label for="description">Description :</label>
            <textarea id="description" name="description" required>{{ old('description', $certificat->description) }}</textarea>
        </div>

        <div>
            <label for="organisme_emetteur">Organisme Émetteur :</label>
            <input type="text" id="organisme_emetteur" name="organisme_emetteur" value="{{ old('organisme_emetteur', $certificat->organisme_emetteur) }}" required>
        </div>

        <div>
            <label for="date_attribution">Date d'Attribution :</label>
            <input type="date" id="date_attribution" name="date_attribution" value="{{ old('date_attribution', $certificat->date_attribution) }}" required>
        </div>

        <div>
            <label for="date_expiration">Date d'Expiration :</label>
            <input type="date" id="date_expiration" name="date_expiration" value="{{ old('date_expiration', $certificat->date_expiration) }}" required>
        </div>

        <div>
            <label for="partenaire_id">Partenaire :</label>
            <select id="partenaire_id" name="partenaire_id" required>
                <option value="" disabled {{ old('partenaire_id', $certificat->partenaire_id) ? '' : 'selected' }}>Sélectionnez un partenaire</option>
                @foreach ($partenaires as $partenaire)
                    <option value="{{ $partenaire->id }}" {{ old('partenaire_id', $certificat->partenaire_id) == $partenaire->id ? 'selected' : '' }}>
                        {{ $partenaire->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Modifier</button>
        <a href="{{ route('certificats.index') }}" class="btn-retour">Retour</a>
    </form>
@endsection
