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
        $html = '';
        
        $headerData = [
            'note' => $note,
            'user' => $note->user,
            'validateur' => $note->validateur,
            'controleur' => $note->controleur,
            'etat' => $note->etat
        ];
        $html .= View::make('exports.note-header', $headerData)->render();

        $numero = 1;
        foreach ($note->depenses as $depense)
        {
            $depenseData = [
                'depense' => $depense,
                'details' => json_decode($depense->details, true),
                'fichiers' => Storage::files('public/depenses/' . $depense->id),
                'numero' => $numero,
                'descriptor' => json_decode($depense->nature->descriptor, true)
            ];
            $html .= View::make('exports.depense-page', $depenseData)->render();
            if ($numero < count($note->depenses)) {
                $html .= '<div class="page-break"></div>';
            }
            $numero++;
        }

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