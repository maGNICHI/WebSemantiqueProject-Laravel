@extends('dashboard')

@section('content')
<div class="container">
    <h1>Liste des bateaux</h1>

    @if($bateau->isEmpty())
        <p>Aucun bateau trouvé.</p>
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
                @foreach($bateau as $bateaus)
                    <tr>
                        <td>{{ $bateaus->prix ?? 'N/A' }}</td>
                        <td>{{ $bateaus->description ?? 'N/A' }}</td>
                        <td>
                            @if(isset($bateaus->id))
                                <a href="{{ url('/bateau/' . $bateaus->id . '/edit') }}" class="btn btn-warning">Éditer</a>
                                <form action="{{ url('/bateau/' . $bateaus->id) }}" method="POST" style="display:inline;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger delete-button" data-id="{{ $bateaus->id }}">Supprimer</button>
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

    <a href="{{ url('/bateau/create') }}" class="btn btn-primary">Ajouter un bateau</a>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-button').click(function() {
            var button = $(this);
            var id = button.data('id');
            var form = button.closest('.delete-form');

            // Confirmer la suppression
            if (confirm('Êtes-vous sûr de vouloir supprimer cet bateau ?')) {
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
                        // Supprimer la ligne de l'bateau du tableau
                        button.closest('tr').fadeOut();
                    },
                    error: function(xhr) {
                        // Afficher un message d'erreur
                        alert('Erreur lors de la suppression de l\'bateau : ' + xhr.responseJSON.message);
                    }
                });
            }
        });
    });
</script>
@endsection