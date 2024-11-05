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
    </style>

    <h1>Liste des Certificats</h1>
    <a href="{{ route('certificats.create') }}" class="btn btn-primary" style="margin-top: 12px; margin-bottom: 29px;">Ajouter un Certificat</a>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Organisme Émetteur</th>
                <th>Date d'Attribution</th>
                <th>Date d'Expiration</th>
                <th>Partenaire</th>
                <th>Actions</th> <!-- New column for actions -->
            </tr>
        </thead>
        <tbody>
            @foreach ($certificats as $certificat)
                <tr>
                    <td>{{ $certificat->nom }}</td>
                    <td>{{ $certificat->description }}</td>
                    <td>{{ $certificat->organisme_emetteur }}</td>
                    <td>{{ \Carbon\Carbon::parse($certificat->date_attribution)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($certificat->date_expiration)->format('d/m/Y') }}</td>
                    <td>{{ $certificat->partenaire ? $certificat->partenaire->nom : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('certificats.edit', $certificat->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('certificats.destroy', $certificat->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce certificat ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
