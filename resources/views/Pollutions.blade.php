@extends('dashboard')
@section('content')
<div class="container">
    <h1>Liste des Rapports de Pollution</h1>

    @if($pollutionReports->isEmpty())
        <p>Aucun rapport de pollution trouvé.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Sujet</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Date de Réclamation</th>
                    <th>Date de Traitement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pollutionReports as $report)
                    <tr>
                        <td>{{ $report->sujet ?? 'N/A' }}</td>
                        <td>{{ $report->description ?? 'N/A' }}</td>
                        <td>{{ $report->status ?? 'N/A' }}</td>
                        <td>{{ $report->dateReclamation ?? 'N/A' }}</td>
                        <td>{{ $report->dateTraitement ?? 'N/A' }}</td>
                        <td>
                            @if(isset($report->id))
                                <a href="{{ url('/pollution/' . $report->id . '/edit') }}" class="btn btn-warning">Éditer</a>
                                <form action="{{ url('/pollution/' . $report->id) }}" method="POST" style="display:inline;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger delete-button" data-id="{{ $report->id }}">Supprimer</button>
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

    <a href="{{ url('/pollution/create') }}" class="btn btn-primary">Ajouter un Rapport de Pollution</a>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-button').click(function() {
            var button = $(this);
            var id = button.data('id');
            var form = button.closest('.delete-form');

            // Confirmer la suppression
            if (confirm('Êtes-vous sûr de vouloir supprimer ce rapport de pollution ?')) {
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
                        // Supprimer la ligne du rapport de pollution du tableau
                        button.closest('tr').fadeOut();
                    },
                    error: function(xhr) {
                        // Afficher un message d'erreur
                        alert('Erreur lors de la suppression du rapport de pollution : ' + xhr.responseJSON.message);
                    }
                });
            }
        });
    });
</script>
@endsection
