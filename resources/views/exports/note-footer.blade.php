<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pied de page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ccc;
        }
        .commentaire-section {
            margin-top: 20px;
        }
        .commentaire-section h3 {
            margin-bottom: 10px;
        }
        .commentaire-content {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
        }
        .generation-date {
            text-align: right;
            margin-top: 20px;
            font-style: italic;
        }
    </style>
</head>
<body>
    @if($commentaire)
    <div class="commentaire-section">
        <h3>Commentaires</h3>
        <div class="commentaire-content">
            {{ $commentaire }}
        </div>
    </div>
    @endif

    <div class="generation-date">
        Document généré le {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html> 