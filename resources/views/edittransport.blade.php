@extends('dashboard')

@section('content')

    <h1>Modifier un Transport</h1>

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

    <form action="{{ route('transports.update', $transport->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Spécifie que c'est une requête PUT -->

        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control" required>
                <option value="">Sélectionnez un type de transport</option>
                @foreach (App\Models\Transport::types() as $type)
                    <option value="{{ $type }}" {{ $transport->type === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $transport->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="capacite">Capacité</label>
            <input type="number" name="capacite" id="capacite" class="form-control" value="{{ $transport->capacite }}" required>
        </div>

        <div class="form-group">
            <label for="itineraire_id">Itinéraire</label>
            <select name="itineraire_id" id="itineraire_id" class="form-control" required>
                <option value="">Sélectionnez un itinéraire</option>
                @foreach ($itineraire as $item)
                    <option value="{{ $item->id }}" {{ $transport->itineraire_id === $item->id ? 'selected' : '' }}>{{ $item->nom }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
<a href="{{ route('transports.index') }}" class="btn btn-primary">Retour</a>

    </form>
@endsection
