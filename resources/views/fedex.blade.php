@extends('dashboard')
@section('content')
<div class="container">
    <h1>Ajouter une nouvelle entrée FedEx</h1>
    
    <form action="{{ route('fedex.addFedex') }}" method="POST" class="mb-4">
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
        <table class="table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Nom</th>
                    <th>Numéro de téléphone</th>
                    <th>Adresse</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fedexs as $fedex)
                    <tr>
                        <td>{{ $fedex['email'] ?? 'N/A' }}</td>
                        <td>{{ $fedex['nom'] ?? 'N/A' }}</td>
                        <td>{{ $fedex['numtelephone'] ?? 'N/A' }}</td>
                        <td>{{ $fedex['adresse'] ?? 'N/A' }}</td>
                        <td>{{ $fedex['description'] ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ url('/fedex/create') }}" class="btn btn-primary mt-3">Ajouter un FedEx</a>
</div>
@endsection
