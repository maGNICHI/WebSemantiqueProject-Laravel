@extends('dashboard')
@section('content')
<div class="container">
    <h1>Ajouter une nouvelle entrée FedEx</h1>
    
    <form action="{{ route('fedex.addFedex') }}" method="POST" class="mb-4 p-3 bg-white rounded shadow-sm">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="adresse">Adresse:</label>
            <input type="text" name="adresse" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" name="description" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="nom">Nom:</label>
            <input type="text" name="nom" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="numtelephone">Numéro de téléphone:</label>
            <input type="text" name="numtelephone" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter FedEx</button>
    </form>

    <h2>Liste des FedEx</h2>
    @if(empty($fedexs))
        <p>Aucune donnée FedEx trouvée.</p>
    @else
        <ul class="list-group">
            @foreach($fedexs as $fedex)
                <li class="list-group-item mb-2">
                    <strong>{{ $fedex['nom'] }}</strong>
                    <div class="fedex-details">
                        Email: {{ $fedex['email'] }}<br>
                        Adresse: {{ $fedex['adresse'] }}<br>
                        Description: {{ $fedex['description'] }}<br>
                        Numéro de téléphone: {{ $fedex['numtelephone'] }}<br>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
