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

        dd($headerData);
        $html .= View::make('exports.note-header', $headerData)->render();

        $numero = 1;
        foreach ($note->depenses as $depense)
        {
            $fichiers = [];
            foreach (Storage::files('public/depenses/' . $depense->id) as $fichier) {
                try {
                    $fullPath = storage_path('app/private/' .$fichier);
                    if (file_exists($fullPath)) {
                        $mimeType = mime_content_type($fullPath);
                        $isImage = str_starts_with($mimeType, 'image/');
                        
                        $fichiers[] = [
                            'nom' => basename($fichier),
                            'mime' => $mimeType,
                            'isImage' => $isImage,
                            'data' => $isImage ? base64_encode(file_get_contents($fullPath)) : null
                        ];
                        
                        if ($isImage) {
                            \Log::info('Taille des données image pour ' . basename($fichier) . ': ' . 
                                strlen(base64_encode(file_get_contents($fullPath))) . ' caractères');
                        }
                    }
                } catch (\Exception $e) {
                    \Log::error('Erreur lors de la lecture du fichier: ' . $e->getMessage());
                }
            }

            $depenseData = [
                'depense' => $depense,
                'details' => json_decode($depense->details, true),
                'fichiers' => $fichiers,
                'numero' => $numero,
                'descriptor' => json_decode($depense->nature->descriptor, true)
            ];
            $html .= View::make('exports.depense-page', $depenseData)->render();
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