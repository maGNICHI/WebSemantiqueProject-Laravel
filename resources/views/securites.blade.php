@extends('dashboard')
@section('content')
<div class="container">
    <h1>Liste des Signalements de Sécurité</h1>

    @if($securiteReports->isEmpty())
        <p>Aucun signalement de sécurité trouvé.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Sujet</th>
                    <th>Description</th>
                    <th>Status</th>
          
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($securiteReports as $securite)
                    <tr>
                        <td>{{ $securite->sujet ?? 'N/A' }}</td>
                        <td>{{ $securite->description ?? 'N/A' }}</td>
                        <td>{{ $securite->status ?? 'N/A' }}</td>
                  
          
                        <td>
                            @if(isset($securite->id))
                                <a href="{{ url('/securite/' . $securite->id . '/edit') }}" class="btn btn-warning">Éditer</a>
                                <form action="{{ url('/securite/' . $securite->id) }}" method="POST" style="display:inline;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger delete-button" data-id="{{ $securite->id }}">Supprimer</button>
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

    <a href="{{ url('/securite/create') }}" class="btn btn-primary">Ajouter un Signalement de Sécurité</a>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-button').click(function() {
            var button = $(this);
            var id = button.data('id');
            var form = button.closest('.delete-form');

            // Confirmer la suppression
            if (confirm('Êtes-vous sûr de vouloir supprimer ce signalement de sécurité ?')) {
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
                        // Supprimer la ligne de sécurité du tableau
                        button.closest('tr').fadeOut();
                    },
                    error: function(xhr) {
                        // Afficher un message d'erreur
                        alert('Erreur lors de la suppression du signalement de sécurité : ' + xhr.responseJSON.message);
                    }
                });
            }
        });
    });
</script>
@endsection

