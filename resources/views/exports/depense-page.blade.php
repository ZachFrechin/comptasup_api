<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dépense</title>
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
        .details-section {
            margin-top: 20px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .details-table th,
        .details-table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .details-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .details-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .file-indicator {
            color: #666;
            font-style: italic;
        }
        .files-section {
            margin-top: 20px;
        }
        .files-list {
            list-style: none;
            padding: 0;
        }
        .files-list li {
            margin-bottom: 15px;
        }
        .file-image {
            max-width: 100%;
            max-height: 300px;
            margin-top: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
        }
        .file-name {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .depense-number {
            font-size: 1.2em;
            margin-bottom: 5px;
        }
        .depense-reference {
            font-size: 0.8em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="depense-number">Dépense N° {{ $numero }}</div>
        <div class="depense-reference">cf: {{ $depense->id }}</div>
        <p>Date : {{ $depense->date }}</p>
    </div>

    <div class="info-section">
        <h3>Informations de base</h3>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Montant TTC :</span>
                <span>{{ number_format($depense->totalTTC, 2) }} €</span>
            </div>
            <div class="info-item">
                <span class="info-label">Tiers :</span>
                <span>{{ $depense->tiers }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">SIRET :</span>
                <span>{{ $depense->SIRET }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Nature :</span>
                <span>{{ $depense->nature->nom }}</span>
            </div>
        </div>
    </div>

    <div class="details-section">
        <h3>Détails</h3>
        <table class="details-table">
            <thead>
                <tr>
                    <th>Champ</th>
                    <th>Valeur</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $key => $value)
                    <tr>
                        <td>{{ ucfirst($key) }}</td>
                        <td>
                            {{ $value }}
                            @if(isset($descriptor[$key]) && $descriptor[$key]['type'] === 'file')
                                <div class="file-indicator">(Fichier joint)</div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if(count($fichiers) > 0)
    <div class="files-section">
        <h3>Fichiers joints</h3>
        <ul class="files-list">
            @foreach($fichiers as $fichier)
                <li>
                    <div class="file-name">{{ $fichier['nom'] }}</div>
                    @if($fichier['isImage'])
                        {{-- <img src="data:{{ $fichier['mime'] }};base64,{{ $fichier['data'] }}" 
                             class="file-image" 
                             alt="{{ $fichier['nom'] }}"> --}}
                             {{ $fichier['mime'] }}
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    @endif
</body>
</html> 