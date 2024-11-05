@extends('dashboard')

@section('content')
<div class="container">
    <h1>Liste des bus</h1>

    @if($bus->isEmpty())
        <p>Aucun bus trouvé.</p>
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
                @foreach($bus as $bas)
                    <tr>
                        <td>{{ $bas->prix ?? 'N/A' }}</td>
                        <td>{{ $bas->description ?? 'N/A' }}</td>
                        <td>
                            @if(isset($bas->id))
                                <a href="{{ url('/bus/' . $bas->id . '/edit') }}" class="btn btn-warning">Éditer</a>
                                <form action="{{ url('/bus/' . $bas->id) }}" method="POST" style="display:inline;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger delete-button" data-id="{{ $bas->id }}">Supprimer</button>
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

    <a href="{{ url('/bus/create') }}" class="btn btn-primary">Ajouter un bus</a>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-button').click(function() {
            var button = $(this);
            var id = button.data('id');
            var form = button.closest('.delete-form');

            // Confirmer la suppression
            if (confirm('Êtes-vous sûr de vouloir supprimer cet bus ?')) {
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
                        // Supprimer la ligne de le bus du tableau
                        button.closest('tr').fadeOut();
                    },
                    error: function(xhr) {
                        // Afficher un message d'erreur
                        alert('Erreur lors de la suppression de le bus : ' + xhr.responseJSON.message);
                    }
                });
            }
        });
    });
</script>
@endsection