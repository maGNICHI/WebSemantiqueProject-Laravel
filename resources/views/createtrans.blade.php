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
    textarea,
    input[type="number"],
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .error {
        border-color: red;
    }

    .error-message {
        color: red;
        font-size: 12px;
    }

    button,
    .btn {
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 15px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover,
    .btn:hover {
        background-color: #0056b3;
    }
</style>

<h1>Ajouter un Transport</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('transports.store') }}" method="POST" id="transportForm">
    @csrf
    <div class="form-group">
        <label for="type">Type</label>
        <select name="type" id="type" class="form-control">
            <option value="">Sélectionnez un type de transport</option>
            @foreach (App\Models\Transport::types() as $type)
                <option value="{{ $type }}">{{ ucfirst($type) }}</option>
            @endforeach
        </select>
        <div class="error-message" id="error-type"></div> <!-- Message d'erreur -->
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control"></textarea>
        <div class="error-message" id="error-description"></div> <!-- Message d'erreur -->
    </div>

    <div class="form-group">
        <label for="capacite">Capacité</label>
        <input type="number" name="capacite" id="capacite" class="form-control">
        <div class="error-message" id="error-capacite"></div> <!-- Message d'erreur -->
    </div>

    <div class="form-group">
        <label for="itineraire_id">Itinéraire</label>
        <select name="itineraire_id" id="itineraire_id" class="form-control">
            <option value="">Sélectionnez un itinéraire</option>
            @foreach ($itineraire as $item)
                <option value="{{ $item->id }}">{{ $item->nom }}</option>
            @endforeach
        </select>
        <div class="error-message" id="error-itineraire_id"></div> <!-- Message d'erreur -->
    </div>

    <button type="submit" class="btn">Ajouter le Transport</button>
    <a href="{{ route('itineraires.index') }}" class="btn">Retour</a>
</form>


</script>
@endsection
