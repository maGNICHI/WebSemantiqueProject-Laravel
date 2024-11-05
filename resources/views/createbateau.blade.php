@extends('dashboard')

@section('content')
<div class="container">
    <h1>Ajouter un Bateau</h1>

    <form action="{{ url('/bateau') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="prix">Prix:</label>
            <input type="number" name="prix" id="prix" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter bateau</button>
    </form>
</div>
@endsection