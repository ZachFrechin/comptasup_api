<?php

namespace App\Http\Services;

use App\Http\Services\Service;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OcrService extends Service
{
    public function getOCRResult(UploadedFile $image) : string | null
    {
        try {
            $url = config('services.ocr.url', 'http://localhost:8000/ocr');
            Log::info('Sending OCR request to: ' . $url);
            
            $response = Http::timeout(30)
                ->attach(
                    'image', 
                    file_get_contents($image->getPathname()), 
                    $image->getClientOriginalName()
                )->post($url);
            
            if ($response->successful()) {
                return $response->json();
            }

            Log::error('OCR request failed', [
                'status' => $response->status(),
                'body' => $response->body(),
                'url' => $url
            ]);
            
            return null;
        } catch (\Exception $e) {
            Log::error('OCR request exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}

