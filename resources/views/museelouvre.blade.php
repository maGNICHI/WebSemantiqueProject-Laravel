@extends('dashboard')

@section('content')
<div class="container">
    <h1>Liste des Musées</h1>
    <div class="search-container" style="margin-bottom: 20px;">
            <form action="{{ url('/museelouvre') }}" method="GET">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher une activité..." style="padding: 10px; width: 300px; border-radius: 5px; border: 1px solid #ddd;">
                <button type="submit" class="btn btn-primary" style="padding: 10px; border-radius: 5px;">Rechercher</button>
            </form>
        </div>
    @if($museelouvre->isEmpty())
        <p>Aucun museelouvre trouvé.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>titre</th>
                    <th>Description</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($museelouvre as $musee)
                    <tr>
                        <td>{{ $musee->titre  }}</td>
                        <td>{{ $musee->description  }}</td>
                        <td>
                            @if(isset($musee->id))
                                <a href="{{ url('/museelouvre/' . $musee->id . '/edit') }}" class="btn btn-warning">Éditer</a>
                                <form action="{{ url('/museelouvre/' . $musee->id) }}" method="POST" style="display:inline;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger delete-button" data-id="{{ $musee->id }}">Supprimer</button>
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

    <a href="{{ url('/museelouvre/create') }}" class="btn btn-primary">Ajouter un museelouvre</a>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-button').click(function() {
            var button = $(this);
            var id = button.data('id');
            var form = button.closest('.delete-form');

            // Confirmer la suppression
            if (confirm('Êtes-vous sûr de vouloir supprimer cet museelouvre ?')) {
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
                        // Supprimer la ligne de le museelouvre du tableau
                        button.closest('tr').fadeOut();
                    },
                    error: function(xhr) {
                        // Afficher un message d'erreur
                        alert('Erreur lors de la suppression de le museelouvre : ' + xhr.responseJSON.message);
                    }
                });
            }
        });
    });
</script>
@endsection