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
    </style>

    <h1>Liste des Itinéraires</h1>
    <a href="{{ route('itineraires.create') }}" class="btn btn-primary" style="margin-top: 12px; margin-bottom: 29px;">Ajouter un Itinéraire</a>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Durée</th>
                <th>Destination</th> <!-- Nouvelle colonne pour la destination -->
                <th>Actions</th> <!-- Colonne pour les actions -->
            </tr>
        </thead>
        <tbody>
            @foreach ($itineraire as $item)
                <tr>
                    <td>{{ $item->nom }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->duree }}</td>
                    <td>{{ $item->destination->nom }}
                    <td>
                        <a href="{{ route('itineraires.edit', $item->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('itineraires.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet itinéraire ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
