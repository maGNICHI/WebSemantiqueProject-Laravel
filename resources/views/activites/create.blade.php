@extends('dashboard')

@section('content')
    <style>
        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .btn-retour {
            display: inline-block;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-retour:hover {
            background-color: #0056b3;
        }
    </style>

    <h1>Ajouter une Activité</h1>

    <form action="{{ route('activites.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="titre">Titre (max 255 caractères) :</label>
            <input type="text" id="titre" name="titre" value="{{ old('titre') }}" required maxlength="255" minlength="5" placeholder="Entrez le titre de l'activité">
            @error('titre')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="contenu">Contenu (min 20 caractères) :</label>
            <textarea id="contenu" name="contenu" required minlength="20" placeholder="Décrivez l'activité">{{ old('contenu') }}</textarea>
            @error('contenu')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="image">URL de l'image :</label>
            <input type="file" id="image" name="image">
        </div>

        <button type="submit">Ajouter</button>
        <a href="{{ route('activites.index') }}" class="btn-retour">Retour</a>
    </form>
@endsection
