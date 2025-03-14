<?php

namespace App\Http\Services;

use App\Models\Note;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ExportService extends Service
{
    public function generatePDF(Note $note)
    {
        // En-tête de la note
        $headerData = [
            'note' => $note,
            'user' => $note->user,
            'validateur' => $note->validateur,
            'controleur' => $note->controleur,
            'etat' => $note->etat
        ];

        // Préparation des données des dépenses
        $depensesData = [];
        $numero = 1;
        foreach ($note->depenses as $depense) {
            $fichiers = [];
            foreach (Storage::files('public/depenses/' . $depense->id) as $fichier) {
                $path = Storage::path($fichier);
                $mimeType = mime_content_type($path);
                $fichiers[] = [
                    'nom' => basename($fichier),
                    'mime' => $mimeType,
                    'isImage' => str_starts_with($mimeType, 'image/'),
                    'data' => str_starts_with($mimeType, 'image/') ? base64_encode(file_get_contents($path)) : null
                ];
            }

            $depensesData[] = [
                'depense' => $depense,
                'details' => json_decode($depense->details, true),
                'fichiers' => $fichiers,
                'numero' => $numero,
                'descriptor' => json_decode($depense->nature->descriptor, true)
            ];
            $numero++;
        }

        // Génération du HTML complet
        $data = [
            'header' => $headerData,
            'depenses' => $depensesData
        ];

        $html = View::make('exports.pdf-template', $data)->render();
        
        $pdf = Pdf::loadHTML($html);
        $pdf->setPaper('A4');
        
        return $pdf->download('note-de-frais-' . $note->id . '.pdf');
    }

    public function generateCSV(Note $note)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="note-de-frais-' . $note->id . '.csv"',
        ];

        $callback = function() use ($note)
        {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, ['ID', 'Date', 'Montant TTC', 'Tiers', 'SIRET', 'Nature', 'Détails']);
            
            foreach ($note->depenses as $depense) 
            {
                fputcsv($file, [
                    $depense->id,
                    $depense->date,
                    $depense->totalTTC,
                    $depense->tiers,
                    $depense->SIRET,
                    $depense->nature->nom,
                    $depense->details
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
} 