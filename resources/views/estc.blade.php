@extends('dashboard')

@section('content')
<div class="container">
    <h1>Liste des Estc</h1>

    @if($estc->isEmpty())
        <p>Aucun Estc trouvé.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Lieu</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($estc as $estc)
                    <tr>
                        <td>{{ $estc->nom ?? 'N/A' }}</td>
                        <td>{{ $estc->description ?? 'N/A' }}</td>
                        <td>{{ $estc->lieu ?? 'N/A' }}</td>
                        <td>
                            @if(isset($estc->id))
                                <a href="{{ url('/estc/' . $estc->id . '/edit') }}" class="btn btn-warning">Éditer</a>
                                <form action="{{ url('/estc/' . $estc->id) }}" method="POST" style="display:inline;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger delete-button" data-id="{{ $estc->id }}">Supprimer</button>
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

    <a href="{{ url('/estc/create') }}" class="btn btn-primary">Ajouter un Estc</a>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-button').click(function() {
            var button = $(this);
            var id = button.data('id');
            var form = button.closest('.delete-form');

            // Confirm deletion
            if (confirm('Êtes-vous sûr de vouloir supprimer cet Estc ?')) {
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Show success message
                        alert(response.message);
                        // Remove the Estc row from the table
                        button.closest('tr').fadeOut();
                    },
                    error: function(xhr) {
                        // Show error message
                        alert('Erreur lors de la suppression de l\'Estc : ' + xhr.responseJSON.message);
                    }
                });
            }
        });
    });
</script>
@endsection
