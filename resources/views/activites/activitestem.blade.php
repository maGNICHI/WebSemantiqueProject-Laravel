<style>
    .background-container {
        background-color: #dfe7f2;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }

    .card-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        padding: 20px;
    }

    .timeline-body {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        width: calc(33.33% - 20px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .timeline-body:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .timeline-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .timeline-header .userimage img {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        margin-right: 10px;
    }

    .username {
        font-weight: bold;
        font-size: 16px;
    }

    .text-muted {
        font-size: 12px;
        color: #999;
        margin-left: auto;
    }

    .timeline-content h4 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .timeline-content p {
        color: #555;
        margin-bottom: 10px;
    }

    .timeline-content img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 10px 0;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .timeline-footer {
        display: flex;
        justify-content: flex-end;
        margin-top: 10px;
    }

    .timeline-footer .btn {
        background-color: #007bff;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .timeline-footer .btn:hover {
        background-color: #0056b3;
    }

    .timeline-comment-box {
        margin-top: 20px;
        width: 100%;
    }

    .input-group {
        display: flex;
        width: 100%;
    }

    .input-group input {
        flex-grow: 1;
        border-radius: 20px;
        padding: 10px;
        border: 1px solid #ccc;
    }

    .input-group button {
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 8px 16px;
        cursor: pointer;
        margin-left: 10px;
    }

    .input-group button:hover {
        background-color: #0056b3;
    }

    .avis-section {
        display: none; /* Masquer par défaut */
        margin-top: 15px;
    }

    .toggle-avis {
        cursor: pointer;
        color: #007bff;
        text-decoration: underline;
        margin-top: 10px;
    }

    .delete-icon {
        color: red;
        cursor: pointer;
        margin-left: 10px;
        font-size: 1.2em;
    }
    
</style>
<head>
    <!-- Other meta tags and links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<div class="background-container">
    @include('nav')

    <h1 style="margin-top: 100px; margin-left: 73px">Liste des Activités et Avis</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <div class="card-container">
        {{-- Formulaire de recherche --}}
        <div class="search-container" style="margin-bottom: 20px;">
            <form action="{{ route('activitestem') }}" method="GET">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher une activité..." style="padding: 10px; width: 300px; border-radius: 5px; border: 1px solid #ddd;">
                <button type="submit" class="btn btn-primary" style="padding: 10px; border-radius: 5px;">Rechercher</button>
            </form>
        </div>

        @foreach($activites as $activite)
            <div class="timeline-body card">
                <div class="timeline-header">
                    <span class="userimage">
                        <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="Avatar" class="user-avatar">
                    </span>
                    <span class="username"> admin</span>
                   <!-- <span class="username"> {{$activite->user->name}}</span>-->
                    <span class="text-muted">Créé le : {{ $activite->created_at->format('F j, Y, g:i a') }}</span>
                </div>
                <div class="timeline-content">
                    <h4>{{ $activite->titre }}</h4>
                    <p>{{ $activite->contenu }}</p>
                    @if($activite->image)
                        <p>
                            <img src="{{ asset('uploads/' . $activite->image) }}" class="img-fluid" width="300" alt="Image de l'activité">
                        </p>
                    @endif
                </div>

                {{-- Réactions et statistiques --}}
                <div class="timeline-footer">
                    <div class="reaction-section">
                        <form action="{{ route('activites.like', $activite->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @if($activite->isLikedBy(auth()->user()))
                                <button type="submit" style="background: none; border: none; cursor: pointer; display: flex; align-items: center;">
                                    <i class="fa fa-thumbs-down fa-fw fa-lg" style="margin-right: 5px;"></i>
                                    <span>Dislike</span>
                                </button>
                            @else
                                <button type="submit" style="background: none; border: none; cursor: pointer; display: flex; align-items: center;">
                                    <i class="fa fa-thumbs-up fa-fw fa-lg" style="margin-right: 5px;"></i>
                                    <span>Like</span>
                                </button>
                            @endif
                        </form>
                    </div>
                    
                    <div class="stats-section" style="margin-left: auto;">
                        <span class="stats-text">{{ $activite->avis()->count() }} Avis</span>
                        <span class="stats-text">{{ $activite->likes()->count() }} Like(s)</span>
                    </div>
                </div>
                

                {{-- Bouton pour afficher/masquer les avis --}}
                <span class="toggle-avis" onclick="toggleAvis(this)">Afficher les avis</span>

                {{-- Section des avis --}}
                <div class="avis-section">
                    @foreach($activite->avis as $avis)
                        <div class="timeline-comment-box">
                            <div class="timeline-header">
                                <span class="userimage"><img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt=""></span>
                                <span class="username">{{$avis->user->name}}</span>
                                <span class="text-muted">{{ $avis->created_at->format('d/m/Y') }}</span>
                                <span class="delete-icon">
                                    <form action="{{ route('avis.destroy', $avis->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE') <!-- Indicate DELETE method -->
                                        <button type="submit" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?');" style="border: none; background: none; cursor: pointer;">
                                            <i class="fas fa-trash-alt fa-fw" style="color: red;"></i>
                                        </button>
                                    </form>
                                    
                                </span>
                                
                               
                            </div>
                            <div class="timeline-content">
                                <p>{{ $avis->contenu }}</p>
                            </div>
                        </div>
                    @endforeach

                    {{-- Formulaire pour ajouter un avis --}}
                    <div class="timeline-comment-box">
                        <div class="input">
                            <form action="{{ route('avis.store', ['activite' => $activite->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="activite_id" value="{{ $activite->id }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Écrire votre avis..." name="contenu" required>
                                    <button type="submit" class="btn btn-primary">Soumettre</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @include('footer')
</div>

<script>
    function toggleAvis(element) {
        const avisSection = element.nextElementSibling; // Trouver la section des avis
        const isVisible = avisSection.style.display === 'block'; // Vérifier si elle est visible

        // Basculer la visibilité
        avisSection.style.display = isVisible ? 'none' : 'block';
        // Mettre à jour le texte du bouton
        element.textContent = isVisible ? 'Afficher les avis' : 'Masquer les avis';
    }

</script>
