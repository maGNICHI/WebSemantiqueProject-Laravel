<style>
    /* Add styles for star rating */
    .star-rating {
        display: flex;
        flex-direction: row-reverse; /* Reverse to make the highest star on the left */
        justify-content: flex-end; /* Align stars to the right */
        margin-top: 10px;
    }

    .star {
        font-size: 30px; /* Size of the stars */
        color: #ddd; /* Default star color */
        cursor: pointer; /* Pointer cursor on hover */
        transition: color 0.2s; /* Smooth color transition */
    }

    /* Change star color on hover */
    .star:hover,
    .star:hover ~ .star {
        color: #f7d51d; /* Color on hover */
    }

    /* Highlight selected stars */
    input[type="radio"]:checked ~ .star {
        color: #f7d51d; /* Color for selected stars */
    }

    /* Hide radio buttons */
    input[type="radio"] {
        display: none;
    }
</style>
<div class="background-container">
    @include('nav')

    <h1 style="margin-top: 100px; margin-left: 73px">Liste des Certificats</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if($expiringSoon->isNotEmpty())
        <div style="margin: 20px; padding: 10px; background-color: #ffcc00; border-radius: 5px;">
            <strong>Alerte:</strong> Certains certificats expirent bientôt!
            <ul>
                @foreach($expiringSoon as $certificat)
                    <li>{{ $certificat->nom }} - Date d'expiration : {{ \Carbon\Carbon::parse($certificat->date_expiration)->format('d/m/Y') }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-container">
        @foreach($certificats as $certificat)
            <div class="card">
                <div class="card-header">
                    <h2>{{ $certificat->nom }}</h2>
                </div>
                <div class="card-body">
                    <p><strong>Description :</strong> {{ $certificat->description }}</p>
                    <p><strong>Organisme Émetteur :</strong> {{ $certificat->organisme_emetteur }}</p>
                    <p><strong>Date d'Attribution :</strong> {{ \Carbon\Carbon::parse($certificat->date_attribution)->format('d/m/Y') }}</p>
                    <p><strong>Date d'Expiration :</strong> {{ \Carbon\Carbon::parse($certificat->date_expiration)->format('d/m/Y') }}</p>
                    <p><strong>Partenaire :</strong> {{ $certificat->partenaire ? $certificat->partenaire->nom : 'N/A' }}</p>
                    <p><strong>Note moyenne :</strong> {{ $certificat->averageRating() ?? 'Aucune note' }}</p>

                    @if(auth()->check())
                        <form action="{{ route('certificats.rate', $certificat->id) }}" method="POST" class="star-rating-form">
                            @csrf
                            <div class="star-rating">
                                @for($i = 5; $i >= 1; $i--) <!-- Display stars from 5 to 1 -->
                                    <input type="radio" name="rating" id="star{{ $certificat->id }}-{{ $i }}" value="{{ $i }}" />
                                    <label class="star" for="star{{ $certificat->id }}-{{ $i }}" title="{{ $i }} stars">★</label>
                                @endfor
                            </div>
                            <button type="submit">Évaluer</button>
                        </form>
                    @else
                        <p>Vous devez être connecté pour évaluer ce certificat.</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    @include('footer')
</div>

