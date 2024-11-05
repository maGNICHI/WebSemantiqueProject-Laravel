@extends('dashboard')
@section('content')
<div class="container">
    <h1>Liste des Musées</h1>

    @if($yuga->isEmpty())
        <p>Aucun yuga trouvé.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>titre</th>
                    <th>Description</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($yuga as $musee)
                    <tr>
                        <td>{{ $musee->titre  }}</td>
                        <td>{{ $musee->description  }}</td>
                        <td>
                            @if(isset($musee->id))
                                <a href="{{ url('/yuga/' . $musee->id . '/edit') }}" class="btn btn-warning">Éditer</a>
                                <form action="{{ url('/yuga/' . $musee->id) }}" method="POST" style="display:inline;" class="delete-form">
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

    <a href="{{ url('/yuga/create') }}" class="btn btn-primary">Ajouter un yuga</a>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-button').click(function() {
            var button = $(this);
            var id = button.data('id');
            var form = button.closest('.delete-form');

            // Confirmer la suppression
            if (confirm('Êtes-vous sûr de vouloir supprimer cet yuga ?')) {
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
                        // Supprimer la ligne de le yuga du tableau
                        button.closest('tr').fadeOut();
                    },
                    error: function(xhr) {
                        // Afficher un message d'erreur
                        alert('Erreur lors de la suppression de le yuga : ' + xhr.responseJSON.message);
                    }
                });
            }
        });
    });
</script>
@endsection