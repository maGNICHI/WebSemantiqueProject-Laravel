@extends('dashboard')

@section('content')
<style>
    /* Form Styles */
    /* ... (Your existing styles) ... */
    
    table {
        width: 100%; /* Prendre toute la largeur */
        border-collapse: collapse; /* Éliminer les espaces entre les cellules */
    }

    th, td {
        padding: 10px; /* Espacement interne des cellules */
        border: 1px solid #ccc; /* Bordure des cellules */
        text-align: left; /* Alignement du texte à gauche */
    }

    th {
        background-color: #f2f2f2; /* Couleur de fond pour l'en-tête */
    }

    tr:nth-child(even) {
        background-color: #f9f9f9; /* Couleur de fond pour les lignes paires */
    }

    .pagination {
        display: flex;
        justify-content: center; /* Center the pagination links */
        margin-top: 20px; /* Add space above pagination */
    }

    .pagination a {
        margin: 0 5px; /* Spacing between pagination links */
        padding: 8px 12px; /* Padding for links */
        background-color: #007bff; /* Background color for links */
        color: white; /* Text color */
        border-radius: 5px; /* Rounded corners */
        text-decoration: none; /* Remove underline */
    }

    .pagination a:hover {
        background-color: #0056b3; /* Darker color on hover */
    }

    .pagination .active a {
        background-color: #0056b3; /* Active page color */
        pointer-events: none; /* Disable clicking on the active page */
    }
</style>

<h1>Logs</h1>
<br>

<table>
    <thead>
        <tr>
            <th>Event</th>
            <th>Partenaire ID</th>
            <th>Date</th>
            <th>Changes</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($audits as $audit)
            <tr>
                <td>{{ $audit->event }}</td>
                <td>{{ $audit->auditable_id }}</td>
                <td>{{ $audit->created_at->format('Y-m-d H:i:s') }}</td>
                <td>
                    @foreach($audit->getModified() as $attribute => $values)
                        <strong>{{ ucfirst($attribute) }}:</strong> 
                        Old: {{ $values['old'] ?? 'N/A' }}, New: {{ $values['new'] ?? 'N/A' }}<br>
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination Links -->
<div class="pagination">
    {{ $audits->links() }}
</div>

@endsection
