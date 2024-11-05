<style>
    .background-container {
        background-color: #dfe7f2;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }

    .main-heading {
        text-align: center;
        margin-top: 60px;
        font-size: 2em;
        color: #333;
    }

    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        margin: 20px;
    }

    .card {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        width: calc(33.33% - 20px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin: 12px 0;
    }

    .card-body {
        margin-bottom: 15px;
    }

    .success-message {
        text-align: center;
        color: green;
        margin: 20px 0;
        font-size: 1.2em;
    }

    .response-text {
        color: red;
    }

    .btn {
        display: inline-block; /* Ensure buttons are displayed inline */
        margin-top: 10px; /* Add some margin above buttons */
    }
</style>

<div class="background-container">
    @include('nav')

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <h3 class="main-heading">Liste de vos réclamations</h3>
    <a href="{{ route('reclamations.create') }}" class="btn" style="margin-bottom: 12px;">Ajouter une Réclamation</a>
    <div class="card-container">
        @foreach($reclamations as $reclamation)
        <div class="card">
            <div class="card-body">
                <p><strong>Sujet :</strong> {{ $reclamation->sujet }}</p>
                <p><strong>Description :</strong> {{ $reclamation->description }}</p>
                @if($reclamation->reponses->isNotEmpty())
                    <p><strong>Réponse(s) :</strong></p>
                    <ul>
                        @foreach($reclamation->reponses as $reponse)
                            <li class="response-text">{{ $reponse->message }}</li>
                        @endforeach
                    </ul>
                @else
                    <p><strong>Réponse :</strong> Aucune réponse associée</p>
                @endif
            </div>

            <a href="{{ route('reclamation.pdf', $reclamation->id) }}" class="btn btn-success">Télécharger en PDF</a>

            @if($reclamation->reponses->isEmpty())
                <a href="{{ route('reclamations.edit', $reclamation->id) }}" class="btn btn-warning">Modifier</a>
            @endif
            
          
            <form action="{{ route('reclamations.destroy', $reclamation->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réclamation ?')">Supprimer</button>
            </form>
        </div>
        @endforeach
    </div>

    @include('footer')
</div>
