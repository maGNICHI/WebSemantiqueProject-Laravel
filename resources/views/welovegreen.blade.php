@extends('dashboard')

@section('content')
<div class="container">
    <h1>Liste des We Love Green</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ url('/welovegreen') }}" class="mb-3">
        <input type="text" name="search" value="{{ old('search', $search) }}" placeholder="Rechercher par nom" class="form-control" />
        <button type="submit" class="btn btn-primary mt-2">Rechercher</button>
    </form>

    @if($welovegreen->isEmpty())
        <p>Aucun We Love Green trouvé.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Lieu</th>
                    <th>Nom</th>
                </tr>
            </thead>
            <tbody>
                @foreach($welovegreen as $we)
                    <tr>
                        <td>{{ $we->description }}</td>
                        <td>{{ $we->lieu }}</td>
                        <td>{{ $we->nom }}</td>
                        <td>
                            @if(isset($we->id))
                                <a href="{{ url('/welovegreen/' . $we->id . '/edit') }}" class="btn btn-warning">Éditer</a>
                                <form action="{{ url('/welovegreen/' . $we->id) }}" method="POST" style="display:inline;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger delete-button" data-id="{{ $we->id }}">Supprimer</button>
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

    <a href="{{ url('/welovegreen/create') }}" class="btn btn-primary">Ajouter un We Love Green</a>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-button').click(function() {
            var button = $(this);
            var id = button.data('id');
            var form = button.closest('.delete-form');

            // Confirmer la suppression
            if (confirm('Êtes-vous sûr de vouloir supprimer cet We Love Green ?')) {
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Afficher un message de succès
                        alert(response.message);
                        // Supprimer la ligne de le We Love Green du tableau
                        button.closest('tr').fadeOut();
                    },
                    error: function(xhr) {
                        // Afficher un message d'erreur
                        alert('Erreur lors de la suppression de le We Love Green : ' + xhr.responseJSON.message);
                    }
                });
            }
        });
    });
</script>
@endsection