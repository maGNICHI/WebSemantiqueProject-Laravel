@extends('dashboard')

@section('content')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<style>
    .audit-card {
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 15px;
        padding: 15px;
        background-color: #f9f9f9;
    }

    details {
        margin-top: 10px; /* Add some margin for details element */
    }

    summary {
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 8px 12px;
        cursor: pointer;
        font-size: 1em;
    }

    .change-added {
        color: green;
    }

    .change-removed {
        color: red;
    }

    .change-header {
        font-weight: bold;
        margin-top: 10px;
    }

    .change-description {
        margin: 0;
        font-size: 0.9em;
    }

    .info {
        margin-top: 10px;
    }

    h1 {
        margin-bottom: 20px;
    }
</style>
<a href="{{ route('partenaires.index') }}" class="btn-retour">Retour</a>

<h1>Audit Logs for Partenaire</h1>


@foreach($audits as $audit)
    <div class="audit-card">
        <details>
            <summary>Show Changes</summary>
            
            <div class="changes">
            <div class="info">
            <strong>Event:</strong> {{ $audit->event }}<br>
            <strong>ID:</strong> {{ $audit->id }}<br>
            <strong>Date:</strong> {{ $audit->created_at->format('Y-m-d H:i:s') }}
        </div>
                @foreach($audit->getModified() as $attribute => $values)
                    <div class="change-header">{{ ucfirst($attribute) }}:</div>
                    <p class="change-description change-removed">
                        <i class="fas fa-minus-circle"></i> Old: {{ $values['old'] ?? 'N/A' }}
                    </p>
                    <p class="change-description change-added">
                        <i class="fas fa-plus-circle"></i> New: {{ $values['new'] ?? 'N/A' }}
                    </p>
                @endforeach
            </div>
        </details>
        <div class="info">
            <strong>Event:</strong> {{ $audit->event }}<br>
            <strong>ID:</strong> {{ $audit->id }}<br>
            <strong>Date:</strong> {{ $audit->created_at->format('Y-m-d H:i:s') }}
        </div>
    </div>
@endforeach
@endsection
