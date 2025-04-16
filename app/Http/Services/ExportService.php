<?php

namespace App\Http\Services;

use App\Models\Note;
use App\Models\Vehicule;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Imagick;
use ImagickException;
use Exception;

class ExportService extends Service
{
    private const PDF_RESOLUTION = 200;
    private const IMAGE_QUALITY = 80;

    public function generatePDF(Note $note)
    {
        $html = $this->generateHeaderHtml($note);
        $html .= $this->generateDepensesHtml($note);
        
        return $this->createPdfResponse($html, $note->id);
    }

    private function generateHeaderHtml(Note $note): string
    {
        $headerData = [
            'note' => $note,
            'user' => $note->user,
            'valideur' => $note->validateur,
            'controleur' => $note->controleur,
            'etat' => $note->etat
        ];

        return View::make('exports.note-header', $headerData)->render();
    }

    private function generateDepensesHtml(Note $note): string
    {
        $html = '';
        $numero = 1;
        $fichiers = [];

        foreach ($note->depenses as $depense) {
            $depenseData = [
                'depense' => $depense,
                'details' => $this->processDetails($depense, $fichiers),
                'fichiers' => $this->processDepenseFiles($depense, $fichiers),
                'numero' => $numero,
                'descriptor' => json_decode($depense->nature->descriptor, true)
            ];

            $html .= View::make('exports.depense-page', $depenseData)->render();
            $numero++;
        }

        return $html;
    }

    private function processDetails($depense, &$fichiers): array
    {
        $details = json_decode($depense->details, true);
        $descriptor = json_decode($depense->nature->descriptor, true);
        $processedDetails = [];

        foreach ($details as $key => $value) {
            $keyDescriptor = $descriptor[$key];

            if ($keyDescriptor['type'] === 'vehicule') {
                $vehicule = Vehicule::find($value);
                if ($vehicule) {
                    $value = [
                        'id' => $vehicule->id,
                        'marque' => $vehicule->brand,
                        'modele' => $vehicule->model,
                        'immatriculation' => $vehicule->immatriculation,
                        'chevaux_fiscaux' => $vehicule->chevaux_fiscaux,
                    ];
                }
            }

            $processedDetails[] = [
                'key' => $key,
                'title' => $keyDescriptor['title'],
                'position' => $keyDescriptor['position'],
                'type' => $keyDescriptor['type'],
                'value' => $value
            ];
        }

        usort($processedDetails, function($a, $b) {
            return $a['position'] <=> $b['position'];
        });

        return $processedDetails;
    }

    private function processDepenseFiles($depense, &$fichiers): array
    {
        $files = Storage::files('public/depenses/' . $depense->id);

        foreach ($files as $fichier) {
            try {
                $this->processDocument($fichier, $fichiers);
            } catch (Exception $e) {
                \Log::error('Error processing file: ' . $e->getMessage());
            }
        }

        return $fichiers;
    }

    private function processDocument($fichier, &$fichiers): void {
        $fullPath = storage_path('app/private/' . $fichier);
                
        if (!file_exists($fullPath)) {
            return;
        }

        $mimeType = mime_content_type($fullPath);
        $isImage = str_starts_with($mimeType, 'image/');
        $isPDF = str_starts_with($mimeType, 'application/pdf');

        if ($isPDF) {
            $fichiers[] = $this->processPdfFile($fichier, $fullPath, $mimeType);
        } else {
            $fichiers[] = $this->processImageFile($fichier, $fullPath, $mimeType, $isImage);
        }
    }

    private function processPdfFile(string $fichier, string $fullPath, string $mimeType): array
    {
        try {
            \Log::info('Processing PDF file: ' . $fullPath);
            
            $imagick = new Imagick();
            $imagick->setResolution(self::PDF_RESOLUTION, self::PDF_RESOLUTION);
            $imagick->readImage($fullPath);

            $pdfImages = [];
            foreach ($imagick as $page) {
                $page->setImageFormat('jpg');
                $page->setImageCompressionQuality(self::IMAGE_QUALITY);
                $pdfImages[] = base64_encode($page->getImageBlob());
            }

            return [
                'nom' => basename($fichier),
                'mime' => $mimeType,
                'isImage' => false,
                'isPDF' => true,
                'data' => $pdfImages
            ];
        } catch (ImagickException $e) {
            \Log::error('Imagick error: ' . $e->getMessage());
            throw $e;
        }
    }

    private function processImageFile(string $fichier, string $fullPath, string $mimeType, bool $isImage): array
    {
        $data = $isImage ? base64_encode(file_get_contents($fullPath)) : null;

        return [
            'nom' => basename($fichier),
            'mime' => $mimeType,
            'isImage' => $isImage,
            'isPDF' => false,
            'data' => $data
        ];
    }

    private function createPdfResponse(string $html, int $noteId)
    {
        $pdf = Pdf::loadHTML($html);
        $pdf->setPaper('A4');
        
        return $pdf->download('note-de-frais-' . $noteId . '.pdf');
    }

    public function generateCSV(Note $note)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="NOTE-DE-FRAIS-' . $note->id . '.csv"',
        ];

        $callback = function() use ($note)
        {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, ['REF', 'Date', 'Nature', 'N°', 'Tiers', 'SIRET', 'Montant TTC (€)']);
            
            foreach ($note->depenses as $depense) 
            {
                fputcsv($file, [
                    $depense->id,
                    $depense->date,
                    $depense->nature->nom,
                    $depense->nature->numero,
                    $depense->tiers,
                    $depense->SIRET,
                    $depense->totalTTC,
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
} 