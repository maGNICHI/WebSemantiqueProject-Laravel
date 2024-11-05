@extends('dashboard')
@section('content')
<div class="container">
    <h1>Ajouter un Bus</h1>

    <form action="{{ url('/bus') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="prix">Prix:</label>
            <input type="number" name="prix" id="prix" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter Bus</button>
    </form>
</div>
@endsection