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

    <h1>Modifier un Partenaire</h1>

    @if ($errors->any())
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('partenaires.update', $partenaire->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom', $partenaire->nom) }}" required>
        </div>

        <div>
            <label for="description">Description :</label>
            <textarea id="description" name="description" required>{{ old('description', $partenaire->description) }}</textarea>
        </div>

        <div>
            <label for="email">Email :</label>
            <input type="text" id="email" name="email" value="{{ old('email', $partenaire->email) }}" required>
        </div>

        <div>
            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" value="{{ old('adresse', $partenaire->adresse) }}" required>
        </div>

        <div>
            <label for="telephone">Téléphone :</label>
            <input type="text" id="telephone" name="telephone" value="{{ old('telephone', $partenaire->telephone) }}" required>
        </div>

        <div>
            <label for="type">Type :</label>
            <select id="type" name="type" required>
                <option value="" disabled {{ old('type', $partenaire->type) ? '' : 'selected' }}>Sélectionnez un type</option>
                @foreach (App\Models\Partenaire::types() as $type)
                    <option value="{{ $type }}" {{ old('type', $partenaire->type) === $type ? 'selected' : '' }}>
                        {{ ucfirst($type) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Modifier</button>
        <a href="{{ route('partenaires.index') }}" class="btn-retour">Retour</a>
    </form>
@endsection
