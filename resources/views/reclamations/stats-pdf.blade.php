{{-- resources/views/reclamations/stats-pdf.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Réclamations</title>
</head>
<body>
    <h1>Statistiques des Réclamations</h1>

    <div>
        {!! $chart->render() !!}
    </div>
</body>
</html>
