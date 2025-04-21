<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Note de frais</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            color: #333;
            line-height: 1.4;
            padding: 40px;
            min-height: 100vh;
            position: relative;
            padding-bottom: 60px; /* Espace pour le footer */
        }

        /* En-tête du document */
        .document-header {
            border-bottom: 2px solid #F2304C;
            padding-bottom: 20px;
            margin-bottom: 30px;
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
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .info-block {
            margin-bottom: 10px;
        }

        .info-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 3px;
        }

        .info-value {
            font-size: 16px;
        }

        .uppercase {
            text-transform: uppercase;
        }

        /* Section total */
        .total-block {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: right;
            border-radius: 4px;
        }

        .total-amount {
            font-size: 20px;
            color: #002B49;
        }

        .amount {
            color: #F2304C;
            font-size: 22px;
            font-weight: bold;
            margin-left: 10px;
        }

        /* Section validation */
        .validation-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        /* Pied de page */
        .footer {
            position: absolute;
            bottom: 30px;
            right: 40px;
            text-align: right;
            font-size: 14px;
            color: #666;
            width: calc(100% - 80px); /* Tenir compte du padding du body */
        }

        /* Ajout d'une classe wrapper pour le contenu principal */
        .page-wrapper {
            min-height: calc(100vh - 120px); /* 100vh moins padding-top/bottom du body et espace footer */
        }

        .history-container {
            border: 1px solid #eee;
            border-radius: 4px;
            padding: 15px;
            background-color: #f8f9fa;
        }

        .history-item {
            display: flex;
            flex-direction: column;
            padding: 12px 15px;
            background-color: white;
            border-radius: 4px;
            margin-bottom: 8px;
        }

        .history-item:last-child {
            margin-bottom: 0;
        }

        .history-main-line {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .history-date-line {
            display: flex;
            align-items: center;
            color: #666;
            font-size: 14px;
        }

        .history-state {
            font-weight: 500;
            color: #002B49;
            min-width: 200px;
        }

        .history-user {
            color: #666;
            min-width: 200px;
        }

        .history-separator {
            color: #F2304C;
            margin: 0 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    @php
        use App\Helpers\StateTranslator;
    @endphp

    <div class="page-wrapper">
        <div class="document-header">
            <h1 class="document-title">Note de frais</h1>
            <div class="document-number">Réf #{{ $note->id }}</div>
        </div>

        <div class="content-container">
            <div class="section">
                <h2 class="section-title">Informations générales</h2>
                <div class="info-grid">
                    <div class="info-block">
                        <div class="info-label">Demandeur</div>
                        <div class="info-value">
                            <span class="uppercase">{{ $user->profil->nom }}</span> {{ $user->profil->prenom }}
                        </div>
                        <div class="info-value">{{ $user->email }}</div>
                    </div>
                    <div class="info-block">
                        <div class="info-label">Service</div>
                        <div class="info-value">{{ $user->profil->service->nom ?? 'Non spécifié' }}</div>
                    </div>
                    <div class="info-block">
                        <div class="info-label">Date de création</div>
                        <div class="info-value">{{ $note->created_at->format('d/m/Y') }}</div>
                        <div class="info-label">Nombre de dépenses</div>
                        <div class="info-value">{{ $note->depenses->count() }}</div>
                    </div>
                </div>

                <div class="total-block">
                    <div class="total-amount">
                        Total TTC <span class="amount">{{ number_format($note->depenses->sum("totalTTC"), 2, ',', ' ') }} €</span>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2 class="section-title">Historique des modifications</h2>
                <div class="history-container">
                    @foreach($note->history as $transition)
                        <div class="history-item">
                            <div class="history-main-line">
                                <span class="history-state">{{ StateTranslator::translate($transition->baseEtat) }} -> {{ StateTranslator::translate($transition->finalEtat) }}</span>
                                <span class="history-separator">|</span>
                                <span class="history-user">
                                    <span class="uppercase">{{ $transition->user->profil->nom }}</span> {{ $transition->user->profil->prenom }}
                                </span>
                            </div>
                            <div class="history-date-line">
                                {{ $transition->created_at->timezone('Europe/Paris')->format('d/m/Y à H:i') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        @php
            setlocale(LC_TIME, 'fr_FR.UTF8');
            date_default_timezone_set('Europe/Paris');
        @endphp
        Document généré le {{ now()->timezone('Europe/Paris')->format('d/m/Y à H:i') }}
    </div>
</body>
</html> 