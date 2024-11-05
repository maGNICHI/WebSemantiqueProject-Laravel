@extends('dashboard')

@section('content')

    <h1>Créer un Événement</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nom">Nom de l'Événement</label> <!-- Nouveau champ "nom" -->
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required>
        </div>

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

        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="date_debut">Date de Début</label>
            <input type="date" name="date_debut" id="date_debut" class="form-control" value="{{ old('date_debut') }}" required>
        </div>

        <div class="form-group">
            <label for="date_fin">Date de Fin</label>
            <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ old('date_fin') }}" required>
        </div>

        <div>
            <label for="image">URL de l'image :</label>
            <input type="file" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="{{ route('events.index') }}" class="btn btn-secondary">Retour</a>

    </form>
@endsection
