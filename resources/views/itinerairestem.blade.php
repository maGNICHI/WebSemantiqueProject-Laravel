
    <style>
        .background-container {
        background-color: #dfe7f2; /* Couleur de fond du conteneur */
        margin: 0;
        padding: 0;
        min-height: 100vh; /* Pour s'assurer que le conteneur prend toute la hauteur de la page */
    }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Espacement entre les cartes */
        }

        .card {
            margin-left:40px;
            margin-top:12px;
            margin-bottom:34px;
            background-color: #f9f9f9; /* Couleur de fond de la carte */
            border: 1px solid #ddd; /* Bordure de la carte */
            border-radius: 8px; /* Coins arrondis */
            padding: 20px; /* Espacement intérieur */
            width: calc(33.33% - 20px); /* Largeur de la carte (3 par ligne) */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Ombre de la carte */
        }

        .card-header {
            margin-bottom: 15px; /* Espacement entre le titre et le corps */
        }

        .card-body {
            margin-bottom: 15px; /* Espacement entre le corps et le pied de page */
        }

        .card-footer {
            display: flex;
            justify-content: space-between; /* Espacement entre les boutons */
        }

        .btn {
            background-color: #007bff; /* Couleur de fond du bouton */
            color: white; /* Couleur du texte du bouton */
            padding: 10px 15px; /* Espacement intérieur du bouton */
            border: none; /* Pas de bordure */
            border-radius: 5px; /* Coins arrondis */
            text-decoration: none; /* Pas de soulignement */
            cursor: pointer; /* Curseur en forme de main */
        }

        .btn:hover {
            background-color: #0056b3; /* Couleur de fond au survol */
        }
    </style>

<div class="background-container">

    @include('nav') {{-- Inclut votre fichier de navigation --}}

    <h1 style="margin-top: 100px; margin-left:73px">Liste des Itinéraires</h1>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<div class="card-container">
    @foreach($itineraire as $item)
        <div class="card">
            <div class="card-header">
                <h2>{{ $item->nom }}</h2>
            </div>
            <div class="card-body">
                <p><strong>Description :</strong>{{ $item->description }}</p>
                <p><strong>Durée :</strong> {{ $item->duree }}</p>
                <p><strong>Destination :</strong> {{ $item->destination->nom }}</p>
            </div>
        <!--    <div class="card-footer">
                <a href="{{ route('itineraires.edit', $item->id) }}" class="btn">Modifier</a>
                <form action="{{ route('itineraires.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn">Supprimer</button>
                </form>
            </div>-->
        </div>
    @endforeach
</div>

    @include('footer') {{-- Inclut votre fichier de pied de page --}}


</div>
