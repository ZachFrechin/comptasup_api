<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\DepenseResource;
use App\Models\Depense;
use App\Http\Requests\DepenseCreateRequest;
use App\Models\Nature;
use Storage;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(["data" => DepenseResource::collection(Depense::all())] ,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepenseCreateRequest $request)
    {
        $depense = Depense::create($request->validated());
        $nature = Nature::where("id", $request->nature_id)->first();

        $natureDescriptor = json_decode($nature->descriptor, true);

        foreach ($natureDescriptor as $key => $value) {
            if ($value["type"] == "file") {

                $name = json_decode($depense->details, true)[$key];

                if($request->hasFile($key)) {
                    $request->file($key)->storeAs('public/depenses/'.$depense->id, $name);
                }
            }
        }
        return response()->json(["data"=> DepenseResource::make($depense) ] ,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Depense $depense)
    {
        return response()->json(["data"=> DepenseResource::make(parameters: $depense) ] ,200);
    }

        
    public function getFile(Depense $depense, string $filename)
    {
        $filePath = storage_path('app/private/public/depenses/' . $depense->id . '/' . $filename);


        // Vérifiez si le fichier existe
        if (file_exists($filePath)) {
            return response()->file($filePath);
        } else {
            return response()->json(['message' => 'File not found'], 404);
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Depense $depense)
    {
        // Define validation rules, but don't validate 'nature_id' if it's not present
        $validated = $request->validate([
            'totalTTC' => 'numeric|min:0',
            'date' => 'date',
            'tiers' => 'string|max:255',
            'nature_id' => 'nullable|exists:natures,id', // Make it nullable to allow skipping
            'details' => 'json'
        ]);

        // If details are provided and changed, handle related file uploads
        if ($request->has('details') && $request->input('details') !== json_decode($depense->details, true)) {
            $nature = Nature::findOrFail($validated['nature_id'] ?? $depense->nature_id);
            $natureDescriptor = json_decode($nature->descriptor, true);

            foreach ($natureDescriptor as $key => $value) {
                if ($value["type"] === "file") {
                    $name = json_decode($depense->details, true)[$key] ?? null;

                    // Delete old file if it exists
                    if ($name) {
                        $filePath = storage_path('app/public/depenses/' . $depense->id . '/' . $name);
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                    }

                    // Store new file if it exists in the request
                    if ($request->hasFile($key)) {
                        $request->file($key)->storeAs('public/depenses/' . $depense->id, $name);
                    }
                }
            }
        }

        // Update only provided fields or skip if not present
        foreach ($validated as $key => $value) {
            if ($value !== null) {
                $depense->$key = $value;
            }
        }

        // Save the updated depense
        $depense->save();

        // Update the related note if necessary
        $note = $depense->note;
        if ($note) {
            $note->etat_id = 1;
            $note->save();
        }

        // Return the updated depense in the response
        return response()->json(["data" => DepenseResource::make($depense)], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
