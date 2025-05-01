<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dépense</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.4;
            padding: 40px;
            min-height: 100vh;
            position: relative;
            padding-bottom: 60px;
        }

        /* En-tête du document */
        .document-header {
            border-bottom: 2px solid #F2304C;
            padding-bottom: 20px;
            margin-bottom: 30px;
            text-align: center;
        }

        .document-title {
            font-size: 28px;
            color: #002B49;
        }

        .document-number {
            color: #F2304C;
            font-size: 18px;
            margin-top: 5px;
        }

        /* Contenu principal */
        .content-container {
            margin-bottom: 30px;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            color: #002B49;
            font-size: 20px;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
        }

        /* Grille d'informations */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .info-block {
            margin-bottom: 0;
            padding: 15px;
            border-left: 3px solid #002B49;
        }

        .info-label {
            font-size: 14px;
            color: #002B49;
            margin-bottom: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .info-value {
            font-size: 18px;
            color: #333;
        }

        .info-value.montant {
            color: #F2304C;
            font-weight: bold;
            font-size: 24px;
        }

        /* Table des détails */
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .details-table th,
        .details-table td {
            padding: 12px;
            border: 1px solid #dee2e6;
            font-size: 14px;
        }

        .details-table th {
            background-color: #002B49;
            color: white;
            font-weight: normal;
        }

        .details-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        /* Section fichiers */
        .files-section {
            margin-top: 30px;
        }

        .files-list {
            list-style: none;
            padding: 0;
        }

        .files-list li {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }

        .file-name {
            color: #002B49;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .file-image {
            max-width: 100%;
            max-height: 800px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }


        .pdf-page {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 4px;
            border: 1px solid #dee2e6;
        }

        .page-number {
            color: #002B49;
            font-size: 14px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .file-indicator {
            color: #F2304C;
            font-size: 14px;
            margin-top: 5px;
        }

        .vehicule-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }

        .vehicule-info-item {
            display: flex;
            flex-direction: column;
        }

        .vehicule-info-item .label {
            font-size: 12px;
            color: #666;
            margin-bottom: 2px;
        }

        .vehicule-info-item .value {
            font-size: 14px;
            color: #002B49;
            font-weight: 500;
        }

        /* Pied de page */
        .footer {
            position: absolute;
            bottom: 30px;
            right: 40px;
            text-align: right;
            font-size: 14px;
            color: #666;
            width: calc(100% - 80px);
        }

        .person-card {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 10px;
            font-size: 14px;
            line-height: 1.4;
        }

        .person-card .name {
            font-weight: bold;
            color: #333;
        }

        .person-card .email,
        .person-card .company,
        .person-card .siret {
            color: #555;
            font-size: 13px;
        }

    </style>
</head>
<body>
    <div class="document-header">
        <h1 class="document-title">Dépense N°{{ $numero }}</h1>
        <div class="document-number">Réf #{{ $depense->id }}</div>
        <div class="info-value">Date : {{ \Carbon\Carbon::parse($depense->date)->format('d/m/Y') }}</div>
    </div>

    <div class="content-container">
        <div class="section">
            <h2 class="section-title">Informations de base</h2>
            <div class="info-grid">
                <div class="info-block">
                    <div class="info-label">Montant TTC</div>
                    <div class="info-value montant">{{ number_format($depense->totalTTC, 2, ',', ' ') }} €</div>
                </div>
                <div class="info-block">
                    <div class="info-label">Nature</div>
                    <div class="info-value">{{ $depense->nature->nom }}</div>
                </div>
            </div>
        </div>

        <div class="section">
            <h2 class="section-title">Détails de la dépense</h2>
            <table class="details-table">
                <thead>
                    <tr>
                        <th>Champ</th>
                        <th>Valeur</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $detail)
                        @if($detail['type'] !== 'file')
                        <tr>
                            <td>{{ $detail['title'] }}</td>
                            <td>
                                @if($detail['type'] === 'vehicule')
                                    <div class="vehicule-info">
                                        <div class="vehicule-info-item">
                                            <span class="label">Marque</span>
                                            <span class="value">{{ $detail['value']['marque'] }}</span>
                                        </div>
                                        <div class="vehicule-info-item">
                                            <span class="label">Modèle</span>
                                            <span class="value">{{ $detail['value']['modele'] }}</span>
                                        </div>
                                        <div class="vehicule-info-item">
                                            <span class="label">Immatriculation</span>
                                            <span class="value">{{ $detail['value']['immatriculation'] }}</span>
                                        </div>
                                        <div class="vehicule-info-item">
                                            <span class="label">Chevaux Fiscaux</span>
                                            <span class="value">{{ $detail['value']['chevaux_fiscaux'] }} CV</span>
                                        </div>
                                    </div>
                                @elseif($detail['type'] === 'siret')
                                    @php
                                        $siret = $detail['value'];
                                        $formatted = substr($siret, 0, 3) . '.' .
                                                   substr($siret, 3, 3) . '.' .
                                                   substr($siret, 6, 3) . '.' .
                                                   substr($siret, 9);
                                        echo $formatted;
                                    @endphp
                                @elseif($detail['type'] === 'checkbox')
                                    {{ $detail['value'] ? 'Oui' : 'Non' }}
                                @elseif($detail['type'] === 'collaborateur')
                                    @foreach($detail['value'] as $collaborateur)
                                        <div class="person-card">
                                            <div class="name">{{ $collaborateur['prenom'] }} {{ $collaborateur['nom'] }}</div>
                                            <div class="email">{{ $collaborateur['email'] }}</div>
                                        </div>
                                    @endforeach
                                @elseif($detail['type'] === 'invite-informations')
                                    @foreach($detail['value'] as $invite)
                                        <div class="person-card">
                                            <div class="name">{{ $invite['prenom'] }} {{ $invite['nom'] }}</div>
                                            <div class="company">{{ $invite['nom_entreprise'] }}</div>
                                            <div class="siret">SIRET : {{ $invite['siret'] }}</div>
                                        </div>
                                    @endforeach
                                @else
                                    {{ $detail['value'] }}
                                @endif
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        @if(count($fichiers) > 0)
        <div class="section">
            <h2 class="section-title">Fichiers joints</h2>
            <ul class="files-list">
                @foreach($fichiers as $fichier)
                    <li>
                        <div class="file-name">{{ $fichier['nom'] }}</div>
                        @if($fichier['isImage'])
                            <img src="data:{{ $fichier['mime'] }};base64,{{ $fichier['data'] }}"
                                 class="file-image"
                                 alt="{{ $fichier['nom'] }}">
                        @else
                            @foreach($fichier['data'] as $page)
                                <img src="data:image/jpeg;base64,{{ $page }}"
                                     class="file-image"
                                     alt="Page {{ $loop->index + 1 }}">
                            @endforeach
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <div class="footer">
        Document généré le {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>
