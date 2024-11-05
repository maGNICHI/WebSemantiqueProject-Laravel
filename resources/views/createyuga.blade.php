@extends('dashboard')

@section('content')
<div class="container">
    <h1>Ajouter Yuga</h1>
    <form action="{{ url('/yuga') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="titre">titre</label>
            <input  name="titre" id="titre" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection