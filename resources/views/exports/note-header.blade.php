<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Note de frais</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-section h3 {
            margin-bottom: 10px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .info-item {
            margin-bottom: 10px;
        }
        .info-label {
            font-weight: bold;
        }
        .generation-date {
            text-align: right;
            margin-top: 20px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Note de frais</h1>
        <p>N° {{ $note->id }}</p>
    </div>

    <div class="info-section">
        <h3>Informations générales</h3>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Date de création :</span>
                <span>{{ $note->created_at->format('d/m/Y') }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">État :</span>
                <span>{{ $etat->nom }}</span>
            </div>
        </div>
    </div>

    <div class="info-section">
        <h3>Personnes concernées</h3>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Demandeur :</span>
                <span>{{ $user->name }}</span>
            </div>
            @if($validateur)
            <div class="info-item">
                <span class="info-label">Validateur :</span>
                <span>{{ $validateur->name }}</span>
            </div>
            @endif
            @if($controleur)
            <div class="info-item">
                <span class="info-label">Contrôleur :</span>
                <span>{{ $controleur->name }}</span>
            </div>
            @endif
        </div>
    </div>

    <div class="generation-date">
        Document généré le {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html> 