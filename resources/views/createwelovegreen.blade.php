@extends('dashboard')

@section('content')
<div class="container">
    <h1>Ajouter welovegreen</h1>
    <form action="{{ url('/welovegreen') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="lieu">lieu</label>
            <input  name="lieu" id="lieu" class="form-control">
        </div>
        <div class="form-group">
            <label for="nom">nom</label>
            <input  name="nom" id="nom" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection