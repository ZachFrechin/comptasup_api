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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
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
        <p><strong>Date de création :</strong> {{ $note->created_at->format('d/m/Y') }}</p>
        <p><strong>Statut :</strong> {{ $note->etat->nom }}</p>
        <p><strong>Employé :</strong> {{ $note->user->name }}</p>
        @if($note->validateur)
            <p><strong>Validateur :</strong> {{ $note->validateur->name }}</p>
        @endif
        @if($note->controleur)
            <p><strong>Contrôleur :</strong> {{ $note->controleur->name }}</p>
        @endif
    </div>

    <div class="depenses-section">
        <h3>Dépenses</h3>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Montant TTC</th>
                    <th>Tiers</th>
                    <th>SIRET</th>
                    <th>Nature</th>
                    <th>Détails</th>
                </tr>
            </thead>
            <tbody>
                @foreach($depenses as $depense)
                    <tr>
                        <td>{{ $depense->date }}</td>
                        <td>{{ number_format($depense->totalTTC, 2) }} €</td>
                        <td>{{ $depense->tiers }}</td>
                        <td>{{ $depense->SIRET }}</td>
                        <td>{{ $depense->nature->nom }}</td>
                        <td>{{ $depense->details }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($note->commentaire)
        <div class="commentaire-section">
            <h3>Commentaires</h3>
            <p>{{ $note->commentaire }}</p>
        </div>
    @endif

    <div class="footer">
        <p>Document généré le {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>
</html> 