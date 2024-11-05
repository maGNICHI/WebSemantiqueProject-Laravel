@extends('dashboard')

@section('content')
<div class="container">
    <h1>Ajouter un Estc</h1>
    <form action="{{ url('/estc') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="lieu">Lieu</label>
            <input type="text" name="lieu" id="lieu" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="impact_environnemental">Impact Environnemental</label>
            <textarea name="impact_environnemental" id="impact_environnemental" class="form-control" required></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
