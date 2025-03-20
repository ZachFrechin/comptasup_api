<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Changement d'état - Note de frais</title>
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

        .document-header {
            border-bottom: 2px solid #F2304C;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .document-title {
            font-size: 28px;
            color: #002B49;
        }

        .document-subtitle {
            color: #F2304C;
            font-size: 18px;
            margin-top: 5px;
        }

        .content-container {
            margin-bottom: 30px;
        }

        .section {
            margin-bottom: 25px;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 4px;
        }

        .section-title {
            color: #002B49;
            font-size: 20px;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
        }

        .state-change {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px 0;
            padding: 15px;
            background-color: white;
            border-radius: 4px;
        }

        .state {
            padding: 8px 15px;
            background-color: #002B49;
            color: white;
            border-radius: 4px;
        }

        .arrow {
            color: #F2304C;
            font-weight: bold;
            margin: 0 20px;
            font-size: 24px;
        }

        .info-block {
            margin-bottom: 15px;
        }

        .info-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 3px;
        }

        .info-value {
            font-size: 16px;
            color: #002B49;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .footer {
            position: absolute;
            bottom: 30px;
            right: 40px;
            text-align: right;
            font-size: 14px;
            color: #666;
            width: calc(100% - 80px);
        }
    </style>
</head>
<body>
    <div class="document-header">
        <h1 class="document-title">Note de frais - Changement d'état</h1>
        <div class="document-subtitle">Note #{{ $data['note']->id }} - {{ $data['note']->nom }}</div>
    </div>

    <div class="content-container">
        <div class="section">
            <h2 class="section-title">Changement d'état</h2>
            <div class="state-change">
                <span class="state">
                    @php
                        $etats = [
                            'not validated' => 'Non validée',
                            'rejected' => 'Rejetée',
                            'canceled' => 'Annulée',
                            'not_controled' => 'Non contrôlée',
                            'validated' => 'Validée',
                            'archived' => 'Archivée'
                        ];
                    @endphp
                    {{ $etats[$data['ancien_etat']->nom] ?? $data['ancien_etat']->nom }}
                </span>
                <span class="arrow">➔</span>
                <span class="state">{{ $etats[$data['nouvel_etat']->nom] ?? $data['nouvel_etat']->nom }}</span>
            </div>
        </div>

        <div class="section">
            <h2 class="section-title">Détails de l'opération</h2>
            <div class="info-block">
                <div class="info-label">Action effectuée par</div>
                <div class="info-value">
                    <span class="uppercase">{{ $data['operator']->profil->nom }}</span> 
                    {{ $data['operator']->profil->prenom }}
                </div>
                <div class="info-value" style="font-size: 14px;">{{ $data['operator']->email }}</div>
            </div>
        </div>
    </div>

    <div class="footer">
        Email envoyé le {{ now()->format('d/m/Y à H:i') }}
    </div>
</body>
</html>
