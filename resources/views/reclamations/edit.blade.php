<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoVoyageur</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        /* Navigation Bar */
        .main-nav {
            background-color: #f0f3f9;
            padding: 10px 0;
        }

        .main-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: flex-end;
        }

        .main-nav ul li {
            margin-left: 20px;
        }

        .main-nav ul li a {
            color: #333;
            font-weight: 600;
            text-decoration: none;
            padding: 10px 15px;
        }

        .main-nav ul li a:hover {
            color: #007bff;
        }

        .logo {
            font-weight: 800;
            font-size: 1.8em;
            color: #333;
        }

        .logo span {
            color: #1e90ff;
        }

        /* Footer */
        footer {
            background: linear-gradient(to right, #43cea2, #185a9d);
            color: white;
            padding: 30px 0;
            text-align: center;
        }

        footer p {
            margin: 0;
        }

        .social-icons {
            margin-top: 10px;
        }

        .social-icons a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
            font-size: 1.5em;
        }

        .social-icons a:hover {
            color: #333;
        }

        /* Form Styling */
        .form-container {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
            margin-top: 10px;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-group button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="main-nav">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="#" class="logo">ECOVOYAGEUR</a>
            <ul>
            <li class="scroll-to-section"><a href="/" class="active">Home</a></li>
            <li><a href="{{ route('destinations.destination') }}">Destination</a></li>
             <li><a href="{{ route('events.event') }}">Event</a></li>
             <li class="submenu">
        
             <ul>
              <li><a href="{{ route('partenaireStem') }}">Partenaire</a></li>
                                    <li><a href="{{ route('certificatstem') }}">Certificat</a></li>

                                </ul>
                            </li>
                <li><a href="{{ route('reclamations.create') }}"> Réclamation</a></li>
    
            </ul>
        </div>

    <!-- Main Content -->
    <div class="container mt-5">
  
        
        <!-- Form -->
        <div class="container mt-5">
        <!-- Affichage des messages d'alerte -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Formulaire de mise à jour de réclamation -->
        <div class="form-container">
            <h2>Modifier une Réclamation</h2>
            <form action="{{ route('reclamations.update', $reclamation->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="sujet">Sujet :</label>
                    <input type="text" id="sujet" name="sujet" value="{{ old('sujet', $reclamation->sujet) }}" required>
                    @if ($errors->has('sujet'))
                        <div class="text-danger">
                            {{ $errors->first('sujet') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea id="description" name="description" rows="6" required>{{ old('description', $reclamation->description) }}</textarea>
                    @if ($errors->has('description'))
                        <div class="text-danger">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                </div>

                <div class="form-group text-center">
                    <button type="submit">Mettre à jour</button>
                    <a href="{{ route('reclamations.index') }}" class="btn btn-secondary">Retour</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 EcoVoyageur</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-dribbble"></i></a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>






