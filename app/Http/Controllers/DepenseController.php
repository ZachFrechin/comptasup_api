<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use App\Models\Depense;
use Illuminate\Http\Request;
use App\Http\Resources\DepenseResource;
use App\Http\Requests\Depense\DepenseCreateRequest;
use App\Http\Requests\Depense\DepenseUpdateRequest;

class DepenseController extends Controller
{
    /**
     * Affiche la liste des dépenses.
     *
     * @api
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return response()->resourceCollection(DepenseResource::collection(Depense::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @api
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepenseCreateRequest $request)
    {
        $depense = Depense::create($request->validated());
        $natureDescriptor = json_decode(Nature::findOrFail($request->nature_id)->descriptor, true);

        $files = $request->file();
        foreach ($natureDescriptor as $field => $descriptor) {
            if ($descriptor['type'] === 'file' && isset($files[$field])) {
                $files[$field]->storeAs("public/depenses/{$depense->id}", $depense->details[$field] ?? null);
            }
        }

        return response()->resourceCreated(DepenseResource::make($depense));
    }

    /**
     * Affiche une dépense.
     *
     * @api
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function show(Depense $depense)
    {
        return response()->resource(DepenseResource::make($depense));
    }

    /**
     * Affiche un fichier de dépense.
     *
     * @api
     * @param  \App\Models\Depense  $depense
     * @param  string  $filename
     * @return \Illuminate\Http\Response
     */
    public function getFile(Depense $depense, string $filename)
    {
        $filePath = storage_path("app/private/public/depenses/{$depense->id}/{$filename}");

        if (file_exists($filePath)) {
            return response()->file($filePath);
        } else {
            return response()->fileNotFound();
        }
    }

    /**
     * Mettre à jour une dépense.
     *
     * @api
     * @param  \App\Http\Requests\Depense\DepenseUpdateRequest  $request
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function update(DepenseUpdateRequest $request, Depense $depense)
    {
        $validated = $request->validated();

        if ($this->needsFileUpdate($request, $depense)) {
            $this->handleFileUpdates($request, $depense, $validated['nature_id'] ?? $depense->nature_id);
        }

        $this->updateDepense($depense, $validated);
        $this->updateNoteState($depense);

        return response()->resourceUpdated(DepenseResource::make($depense));
    }

    // !--------------------------------------------------------------------------------------------------------------------
    // !PRIVATES METHODES
    // !--------------------------------------------------------------------------------------------------------------------
    
    /**
     * Determines if a file update is necessary based on the request details.
     *
     * @param \Illuminate\Http\Request $request The current HTTP request instance.
     * @param \App\Models\Depense $depense The depense model instance being checked.
     * @return bool Returns true if the details in the request differ from the depense's stored details, indicating a file update is needed.
     */
    private function needsFileUpdate(Request $request, Depense $depense): bool
    {
        return $request->has('details') && $request->input('details') !== json_decode($depense->details, true);
    }

    /**
     * Handle file updates for the given depense, based on the request details and nature descriptor.
     *
     * @param \Illuminate\Http\Request $request The current HTTP request instance.
     * @param \App\Models\Depense $depense The depense model instance being updated.
     * @param int $natureId The ID of the nature related to the depense.
     */
    private function handleFileUpdates(Request $request, Depense $depense, $natureId): void
    {
        $nature = Nature::find($natureId);
        if (!$nature) {
            return;
        }

        $natureDescriptor = json_decode($nature->descriptor, true);
        $oldDetails = json_decode($depense->details, true);

        foreach ($natureDescriptor as $key => $descriptor) {
            if ($descriptor['type'] === 'file') {
                $this->deleteOldFile($oldDetails[$key] ?? null, $depense->id);
                $this->storeNewFile($request, $key, $depense->id);
            }
        }
    }

    /**
     * Deletes an old file if it exists.
     *
     * @param string|null $fileName The filename to delete, or null if no file should be deleted.
     * @param int $depenseId The ID of the depense that the file belongs to.
     */
    private function deleteOldFile(?string $fileName, int $depenseId): void
    {
        if (!$fileName) {
            return;
        }

        $oldFilePath = storage_path("app/public/depenses/{$depenseId}/{$fileName}");
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }
    }

    /**
     * Stores a new file.
     *
     * @param \Illuminate\Http\Request $request The current HTTP request instance.
     * @param string $key The key of the file to store.
     * @param int $depenseId The ID of the depense that the file belongs to.
     */
    private function storeNewFile(Request $request, string $key, int $depenseId): void
    {
        if ($request->hasFile($key)) {
            $request->file($key)->storeAs("public/depenses/{$depenseId}", $key);
        }
    }

    /**
     * Updates a depense.
     *
     * @param \App\Models\Depense $depense The depense to update.
     * @param array $validated The validated data to update the depense with.
     */
    private function updateDepense(Depense $depense, array $validated): void
    {
        $depense->fill(array_filter($validated, fn($value) => $value !== null));
        $depense->save();
    }

    /**
     * Met à jour l'état de la note liée à la dépense, en l'absence de note, ne fait rien.
     *
     * @param \App\Models\Depense $depense La dépense concernée.
     */
    private function updateNoteState(Depense $depense): void
    {
        if ($depense->note) {
            $depense->note->update(['etat_id' => 1]);
        }
    }
}
