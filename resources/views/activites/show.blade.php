

<head>
    <!-- Autres balises -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

@extends('dashboard')

@section('content')
    <h1>Détails de l'Activité : {{ $activite->titre }}</h1>

    <div>
        <p><strong>Titre : </strong>{{ $activite->titre }}</p>
        <p><strong>Contenu : </strong>{{ $activite->contenu }}</p>
        @if($activite->image)
            <p><strong>Image : </strong></p>
            <img src="{{ asset('uploads/' . $activite->image) }}" class="img-fluid" width="300" alt="Image de l'activité">
        @endif
    </div>
    <div class="stats-section" style="margin-left: auto;">
        <span class="stats-text">{{ $activite->avis()->count() }} Avis</span>
        <span class="stats-text">{{ $activite->likes()->count() }} Like(s)</span>
    </div>
    <h2>Avis sur cette activité</h2>
    <ul>
        @foreach($activite->avis as $avis)
            <li>
                {{ $avis->contenu }}
                <form action="{{ route('avis.destroy', $avis->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:none; border:none; color:red;" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?')">
                        <i class="fas fa-trash-alt"></i> <!-- Icône de poubelle -->
                    </button>
                </form>
            </li>
        @endforeach
    </ul>
    
    <a href="{{ route('activites.index') }}" class="btn btn-primary">Retour à la liste</a>
@endsection
