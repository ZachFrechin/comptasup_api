<?php

namespace App\Http\Services;

use App\Http\Services\Service;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class OcrService extends Service
{
    public function getOCRResult(UploadedFile $image) : string | null
    {
        $response = Http::attach(
            'image', 
            file_get_contents($image->getPathname()), 
            $image->getClientOriginalName()
        )->post(config('services.ocr.url', 'http://localhost:8000/api/ocr'));
        
        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}

