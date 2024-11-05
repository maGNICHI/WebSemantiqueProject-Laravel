@extends('dashboard')

@section('content')
    <style>
        .reclamation-details {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .reclamation-details h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .reclamation-details p {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .reponses-list {
            list-style-type: none;
            padding-left: 0;
        }

        .reponses-list li {
            background-color: #f1f1f1;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .btn {
            background-color: #007bff; 
            color: white; 
            padding: 10px 15px; 
            border: none; 
            border-radius: 5px; 
            text-decoration: none; 
            cursor: pointer; 
        }

        .btn:hover {
            background-color: #0056b3; 
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-retour {
            display: inline-block;
            padding: 10px 15px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        .btn-retour:hover {
            background-color: #5a6268;
        }

        .form-group {
            margin-bottom: 15px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .alert {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
    </style>

    <div class="reclamation-details">
        <h1>Détails de la Réclamation</h1>

        <h2>Sujet : {{ $reclamation->sujet }}</h2>
        <p>Description : {{ $reclamation->description }}</p>

        <a href="{{ route('reclamations.index1') }}" class="btn-retour">Retour</a>

        <h3>Ajouter une Réponse</h3>

    
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

     
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reponses.store', $reclamation->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="message">Message :</label>
                <textarea id="message" name="message" required>{{ old('message') }}</textarea> <!-- Utilisation de old() pour conserver les données soumises -->
            </div>
            <button type="submit" class="btn">Ajouter une Réponse</button>
        </form>

        <h3>Réponses</h3>
        <ul class="reponses-list">
            @foreach ($reclamation->reponses as $reponse)
                <li>
                    {{ $reponse->message }}
                    <form action="{{ route('reponses.destroy', [$reclamation->id, $reponse->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réponse ?')">Supprimer</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
