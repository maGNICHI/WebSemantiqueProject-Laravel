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
        margin-top: 12px;
        margin-bottom: 34px;
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
    /* Style pour le formulaire */
/* Style pour le formulaire */
/* Style pour le formulaire */
form {
    padding: 0; /* Suppression de l'espacement intérieur */
    width: 60%; /* Largeur du formulaire */
    margin: 0 auto 40px auto; /* Centrer le formulaire et espacement en bas */
}

/* Conteneur pour les champs de formulaire */
.form-group {
    margin-bottom: 20px; /* Espacement entre les lignes de champs */
}

/* Style des labels du formulaire */
form label {
    font-weight: bold;
    color: #555;
    display: block; /* S'assurer que le label prend toute la largeur */
    margin-bottom: 5px; /* Espacement entre le label et le champ */
}

/* Style des champs de saisie et select */
form input, form select {
    width: 100%; /* Largeur ajustée pour les champs (100%) */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s;
}

/* Focus sur les champs de saisie */
form input:focus, form select:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
}

/* Boutons dans le formulaire */
form .btn {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

form .btn-retour {
    background-color: #6c757d;
    margin-left: 20px;
}

form .btn:hover, form .btn-retour:hover {
    background-color: #0056b3;
}

form .btn-retour:hover {
    background-color: #5a6268;
}

</style>

<div class="background-container">
    @include('nav') {{-- Inclut votre fichier de navigation --}}

    <h1 style="margin-top: 100px; margin-left:73px">Liste des Transports</h1>

    <!-- Formulaire de recherche -->
<!-- Formulaire de recherche -->
<form action="{{ route('transport.search') }}" method="GET" style="margin-left: 73px;">
    <div class="form-group">
        <label for="type">Type de transport :</label>
        <select name="type" id="type">
            <option value="">Tous les types</option>
            @foreach(\App\Models\Transport::types() as $type)
                <option value="{{ $type }}">{{ ucfirst($type) }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="capacite">Capacité :</label>
        <input type="number" name="capacite" id="capacite" placeholder="Capacité">
    </div>

    <div class="form-group">
        <label for="duree">Durée (en heures) :</label>
        <input type="number" name="duree" id="duree" placeholder="Durée">
    </div>

    <!-- Boutons en dessous -->
    <div style="text-align: center;">
        <button type="submit" class="btn">Rechercher</button>
        <button type="button" class="btn btn-retour" onclick="window.location.href='{{ url('transportstem') }}'">Retour</button>
    </div>
</form>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <div class="card-container">
        @foreach($transports as $transport)
            <div class="card">

                <div class="card-body">
                <p><strong>Type :</strong>   {{ $transport->type }}</p>
                    <p><strong>Description :</strong> {{ $transport->description }}</p>
                    <p><strong>Capacité :</strong> {{ $transport->capacite }}</p>
                    @if($transport->itineraire)
        <p><strong>Itinéraire :</strong> {{ $transport->itineraire->nom }}</p> <!-- Affiche le nom de l'itinéraire -->
        <div class="card-footer">
        <a href="{{ route('transports.download-pdf', $transport->id) }}" class="btn">Télécharger PDF</a>
        </div>


        @else
        <p><strong>Itinéraire :</strong> Aucun itinéraire associé</p>
    @endif <!-- Ajoutez cette ligne -->

                </div>
                <!-- Vous pouvez décommenter la section ci-dessous pour ajouter des boutons Modifier et Supprimer -->
                <!--
                <div class="card-footer">
                    <a href="{{ route('transports.edit', $transport->id) }}" class="btn">Modifier</a>
                    <form action="{{ route('transports.destroy', $transport->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn">Supprimer</button>
                    </form>
                </div>
                -->
            </div>
        @endforeach
    </div>

    @include('footer') {{-- Inclut votre fichier de pied de page --}}
</div>
<!-- Script pour gérer le téléchargement de PDF -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function downloadPDF(transportId) {
        $.ajax({
            url: '/transports/' + transportId + '/download-pdf',
            method: 'GET',
            xhrFields: {
                responseType: 'blob'  // Important pour télécharger des fichiers
            },
            success: function (data) {
                // Créer un lien temporaire pour déclencher le téléchargement
                var a = document.createElement('a');
                var url = window.URL.createObjectURL(data);
                a.href = url;
                a.download = 'transport_' + transportId + '.pdf';
                document.body.append(a);
                a.click();
                window.URL.revokeObjectURL(url);
                a.remove();

                // Redirection après le téléchargement
                window.location.href = '/templateTemp';
            },
            error: function () {
                alert('Une erreur est survenue lors du téléchargement du PDF.');
            }
        });
    }
</script>
