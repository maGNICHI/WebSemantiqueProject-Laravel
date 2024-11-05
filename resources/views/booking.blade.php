@extends('dashboard')

@section('content')
<div class="container">
    <h1>Ajouter une nouvelle réservation</h1>
    <form action="{{ route('booking.addBooking') }}" method="POST" class="mb-4">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="adresse">Adresse:</label>
            <input type="text" name="adresse" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" name="description" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="nom">Nom:</label>
            <input type="text" name="nom" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="numtelephone">Numéro de téléphone:</label>
            <input type="text" name="numtelephone" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter la réservation</button>
    </form>

    <h2>Liste des Réservations</h2>
    @if(empty($bookings))
        <p>Aucune réservation trouvée.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Adresse</th>
                    <th>Description</th>
                    <th>Numéro de téléphone</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking['nom'] }}</td>
                        <td>{{ $booking['email'] }}</td>
                        <td>{{ $booking['adresse'] }}</td>
                        <td>{{ $booking['description'] }}</td>
                        <td>{{ $booking['numtelephone'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
