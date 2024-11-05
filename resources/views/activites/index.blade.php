@extends('dashboard')

@section('content')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .btn {
            text-decoration: none; /* Remove underline from links */
            padding: 5px 10px; /* Padding for buttons */
            border-radius: 3px; /* Rounded corners */
            color: white; /* Text color */
        }

        .btn-primary {
            background-color: #007bff; /* Blue background for primary buttons */
        }

        .btn-warning {
            background-color: #ffc107; /* Yellow background for warning buttons */
        }

        .btn-danger {
            background-color: #dc3545; /* Red background for danger buttons */
        }

        .btn:hover {
            opacity: 0.9; /* Slightly decrease opacity on hover */
        }
        .btn-info {
    background-color: #17a2b8; /* Couleur bleue pour le bouton Détails */
}
.chart-container {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .chart-container canvas {
            width: 500px; /* Largeur plus grande */
            height: 250px;
        }
       

    </style>
    </style>

    <h1>Liste des Activités</h1>
    <a href="{{ route('activites.create') }}" class="btn btn-primary" style="margin-top: 12px; margin-bottom: 29px;">Ajouter une Activité</a>

    
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Contenu</th>
                <th>Image</th>
                <th>Nbr Avis</th>
                <th>Nbr likes</th>
                <th>date de creation</th>
                <th>Actions</th> <!-- Colonne pour les actions -->
            </tr>
        </thead>
        <tbody>
            @foreach ($activites as $item)
                <tr>
                    <td>{{ $item->titre }}</td>
                    <td>{{ $item->contenu }}</td>
                    @if($item->image)
                    <td>
                        <img src="{{ asset('uploads/' . $item->image) }}" class="img-fluid" width="150" alt="Image de l'activité">
                    </td>
                    @endif
                    <td>{{ $item->avis()->count() }}</td>
                    <td>{{ $item->likes()->count() }}</td>
                    <td>{{ $item->created_at->format('F j, Y, g:i a') }}</td>
                    <td>
                        <a href="{{ route('activites.show', $item->id) }}" class="btn btn-info">Détails</a>
                        <a href="{{ route('activites.edit', $item->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('activites.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette activité ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="chart-container">
        <div>
            <h2>Activités par Heure</h2>
            <canvas id="activitiesPerHourChart"></canvas>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Activités par heure Chart
        var activitiesPerHourChart = new Chart(document.getElementById('activitiesPerHourChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($activitiesPerHour->pluck('hour')) !!}, // Remplacer par les heures des activités
                datasets: [{
                    label: 'Nombre d\'activités',
                    data: {!! json_encode($activitiesPerHour->pluck('count')) !!}, // Remplacer par le nombre d'activités par heure
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
