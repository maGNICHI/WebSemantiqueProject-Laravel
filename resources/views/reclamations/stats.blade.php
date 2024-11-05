{{-- resources/views/reclamations/stats.blade.php --}}

@extends('dashboard')

@section('content')
    <h1>Statistiques des Réclamations</h1>

    <div class="chart-container" style="height: 500px;">
        {!! $chart->render() !!}
    </div>

    <!-- Export PDF button -->
    <a href="{{ route('reclamations.exportStatistiquesPDF') }}" class="btn btn-primary" style="margin-top: 20px;">
        Exporter les statistiques en PDF
    </a>
@endsection
