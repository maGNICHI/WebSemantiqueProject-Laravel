<!-- resources/views/search.blade.php -->
@extends('layouts.app')

@section('content')
<div class="background-container">
    @include('nav')

    <h1 style="margin-top: 100px; margin-left:73px">Recherche Avancée de Transports</h1>

    <form action="{{ route('transports.advancedSearch') }}" method="GET" style="margin: 20px;">
        <div>
            <label for="type">Type de Transport:</label>
            <select name="type" id="type">
                <option value="">Tous</option>
                @foreach(Transport::types() as $transportType)
                    <option value="{{ $transportType }}">{{ ucfirst($transportType) }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="duree">Durée de l'itinéraire:</label>
            <input type="number" name="duree" id="duree" min="0" placeholder="Durée en minutes">
        </div>

        <div>
            <label for="capacite">Capacité minimale:</label>
            <input type="number" name="capacite" id="capacite" min="0" placeholder="Capacité">
        </div>

        <button type="submit" class="btn">Rechercher</button>
    </form>

    <h2>Résultats de la recherche</h2>
    <div class="card-container">
        @foreach($transports as $transport)
            <div class="card">
                <div class="card-body">
                    <p><strong>Type :</strong> {{ $transport->type }}</p>
                    <p><strong>Description :</strong> {{ $transport->description }}</p>
                    <p><strong>Capacité :</strong> {{ $transport->capacite }}</p>
                    @if($transport->itineraire)
                        <p><strong>Itinéraire :</strong> {{ $transport->itineraire->nom }}</p>
                    @else
                        <p><strong>Itinéraire :</strong> Aucun itinéraire associé</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    @include('footer')
</div>
@endsection
