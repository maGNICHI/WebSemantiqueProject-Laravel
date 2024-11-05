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
            background-color: #007bff; 
            color: white; 
            padding: 10px 15px; 
            border: none; 
            border-radius: 5px; 
            text-decoration: none; 
            cursor: pointer; 
        }

        .btn:hover {
            background-color: #0056b3; 
        }

        .btn-statistics {
            background-color: #28a745;
            color: white;
            margin-bottom: 12px;
        }

        .btn-statistics:hover {
            background-color: #218838;
        }
    </style>

    <h1 style="margin-top: 20px;">Liste des Réclamations (Administrateur)</h1>

    <!-- Export button -->
    <a href="{{ route('reclamations.exportExcel') }}" class="btn" style="margin-bottom: 12px;">Exporter en Excel</a>
    
    <!-- Statistics button -->
    <a href="{{ route('reclamations.stats') }}" class="btn btn-statistics">Voir les Statistiques</a>

    <table>
        <thead>
            <tr>
                <th>Sujet</th>
                <th>Description</th>
                <th>Nom de l'utilisateur</th>
                <th>État</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reclamations as $reclamation)
                <tr>
                    <td>{{ $reclamation->sujet }}</td>
                    <td>{{ $reclamation->description }}</td>
                    <td>{{ $reclamation->user ? $reclamation->user->name : 'Utilisateur non trouvé' }}</td>
                    <td>{{ $reclamation->etat }}</td>
                    <td>
                        <a href="{{ route('reclamations.show', $reclamation->id) }}" class="btn btn-info">Voir</a>
                    
                        <form action="{{ route('reclamations.destroy', $reclamation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réclamation ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
