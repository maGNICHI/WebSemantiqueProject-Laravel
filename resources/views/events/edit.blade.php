@extends('dashboard')

@section('content')

    <h1>Modifier un Événement</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Méthode PUT pour la mise à jour -->

        <div class="form-group">
            <label for="titre">Nom de l'Événement</label>
            <input type="text" name="nom" id="titre" class="form-control" value="{{ $event->nom }}" required>
        </div>
        <div class="form-group">
        <label for="destination_id">Destination</label>
        <select name="destination_id" class="form-control" required>
            <option value="">Choisir une destination</option>
            @foreach ($destinations as $destination)
                <option value="{{ $destination->id }}" {{ $event->destination_id == $destination->id ? 'selected' : '' }}>
                    {{ $destination->nom }}
                </option>
            @endforeach
        </select>
    </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $event->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="date_debut">Date de Début</label>
            <input type="date" name="date_debut" id="date_debut" class="form-control" value="{{ $event->date_debut }}" required>
        </div>

        <div class="form-group">
            <label for="date_fin">Date de Fin</label>
            <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ $event->date_fin }}" required>
        </div>



        <button type="submit" class="btn btn-primary">Modifier</button>
        <a href="{{ route('events.index') }}" class="btn btn-secondary">Retour</a>

    </form>
@endsection
