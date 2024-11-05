@extends('dashboard')

@section('content')
<div class="container">
    <h1>Liste des Avions</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('avions.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher par prix" value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
        </div>
    </form>

    @if($avions->isEmpty())
        <p>Aucun avion trouvé.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Prix</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($avions as $avion)
                    <tr>
                        <td>{{ $avion->prix ?? 'N/A' }}</td>
                        <td>{{ $avion->description ?? 'N/A' }}</td>
                        <td>
                            @if(isset($avion->id))
                                <a href="{{ url('/avion/' . $avion->id . '/edit') }}" class="btn btn-warning">Éditer</a>
                                <form action="{{ route('avions.destroy', ['id' => $avion->id]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet avion ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            @else
                                <span>Actions non disponibles</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ url('/avion/create') }}" class="btn btn-primary">Ajouter un Avion</a>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Your existing JavaScript for delete functionality can go here
    });
</script>
@endsection