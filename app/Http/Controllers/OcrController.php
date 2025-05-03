<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ocr\OcrImageRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class OcrController extends Controller
{
    /**
     * Process an image through OCR service
     */
    public function process(OcrImageRequest $request): JsonResponse
    {
        $image = $request->file('image');
        $response = $this->ocrService->getOCRResult($image);
        
        return response()->json($response);
    }
    

}

