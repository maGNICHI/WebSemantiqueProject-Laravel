@extends('dashboard')


@section('content')
<div class="container">
    <h1>Ajouter un Rapport de Pollution</h1>

    <form action="{{ route('pollution.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="sujet">Sujet:</label>
            <input type="text" name="sujet" id="sujet" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="status">Statut:</label>
            <input type="text" name="status" id="status" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="date_reclamation">Date de Réclamation:</label>
            <input type="date" name="date_reclamation" id="date_reclamation" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="date_traitement">Date de Traitement:</label>
            <input type="date" name="date_traitement" id="date_traitement" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter Rapport de Pollution</button>
    </form>
</div>
@endsection
