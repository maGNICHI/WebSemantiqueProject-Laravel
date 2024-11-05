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
        padding: 8px 12px;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-warning {
        background-color: #ffc107;
        color: black;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        color: black;
    }

    .btn-danger {
        background-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }
</style>

<h1>Liste des Événements</h1>
<a href="{{ route('events.create') }}" class="btn btn-primary" style="margin-top: 12px; margin-bottom: 29px;">Ajouter un Événement</a>

<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Destination</th>
            <th>Date début</th>
            <th>Date fin</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($events as $event)
            <tr>
                <td>{{ $event->nom }}</td>
                <td>{{ $event->description }}</td>
                <td>{{ $event->destination->nom }}</td>
                <td>{{ $event->date_debut }}</td>
                <td>{{ $event->date_fin }}</td>
                <td>
                @if($event->image)
                    <img src="{{ asset('uploads/' . $event->image) }}" class="img-fluid" width="150" alt="Image de l'événement">
                @else
                    <p>Aucune image</p> <!-- Message si pas d'image -->
                @endif
                </td>
                <td>
                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


@endsection
