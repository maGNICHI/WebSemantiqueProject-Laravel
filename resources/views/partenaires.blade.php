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
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-warning {
            background-color: #ffc107;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-info {
            background-color: #17a2b8; /* Add a color for the new button */
        }
    </style>

    <h1>Liste des Partenaires</h1>
    <a href="{{ route('partenaires.create') }}" class="btn btn-primary" style="margin-top: 12px; margin-bottom: 29px;">Ajouter un Partenaire</a>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Téléphone</th>
                <th>Type</th>
                <th>Actions</th> <!-- Nouvelle colonne pour les actions -->
            </tr>
        </thead>
        <tbody>
            @foreach ($partenaires as $partenaire)
                <tr>
                    <td>{{ $partenaire->nom }}</td>
                    <td>{{ $partenaire->description }}</td>
                    <td>{{ $partenaire->email }}</td>
                    <td>{{ $partenaire->adresse }}</td>
                    <td>{{ $partenaire->telephone }}</td>
                    <td>{{ $partenaire->type }}</td>
                    <td>
                        <a href="{{ route('partenaires.edit', $partenaire->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('partenaires.destroy', $partenaire->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce partenaire ?')">Supprimer</button>
                            <a href="{{ route('partenaires.audits', $partenaire->id) }}" class="btn btn-info" style="margin-left: 5px;">Logs d'Activité</a>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
