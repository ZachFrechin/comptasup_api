<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use App\Models\Depense;
use Illuminate\Http\Request;
use App\Http\Resources\DepenseResource;
use App\Http\Requests\Depense\DepenseCreateRequest;
use App\Http\Requests\Depense\DepenseUpdateRequest;
use Illuminate\Support\Facades\Response;

class DepenseController extends Controller
{
    public function index()
    {
       return response()->resourceCollection(DepenseResource::collection(resource: $this->depenseService()->getAll()));
    }

    public function store(DepenseCreateRequest $request)
    {
        $depense = $this->depenseService()->create($request->validated());
        $this->depenseService()->storeFile($depense, $request);

        return response()->resourceCreated(DepenseResource::make($depense));
    }

    public function show(Depense $depense)
    {
        return response()->resource(DepenseResource::make($depense));
    }

    public function getFile(Depense $depense, string $filename)
    {
        $path = $this->depenseService()->getFile($depense, $filename);
        if( $path === null)
        {
            return response()->fileNotFound();
        } else
        {
            return response()->file($path);
        }
    }

    public function update(DepenseUpdateRequest $request, Depense $depense)
    {
        if($request->all() == [])
        {
            return response()->resourceUpdateMissingField(DepenseResource::make($depense));
        }
        
        $this->depenseService()->update($depense, $request->validated());
        $this->depenseService()->storeFile($depense, $request);
        $note = $this->noteService()->getByID($depense->note_id);
        if($note->controleur_id !== $request->user()->id)
        {
            $this->noteService()->changeState(
                $this->etatService()->getByName('not validated')->id,
                $this->noteService()->getByID($depense->note_id)
            );
        }


        return response()->resourceUpdated(DepenseResource::make($depense));
    }
}
