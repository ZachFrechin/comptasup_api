<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use App\Models\Depense;
use Illuminate\Http\Request;
use App\Http\Resources\DepenseResource;
use App\Http\Requests\Depense\DepenseCreateRequest;
use App\Http\Requests\Depense\DepenseUpdateRequest;
use Illuminate\Support\Facades\Response;

class IndemniteKilometriqueController extends Controller
{
    public function index()
    {
        return response()->json($this->indemniteKilometriqueService()->retrieve());
    }

    public function store(Request $request)
    {
        $this->indemniteKilometriqueService()->store($request->all());
        return response()->json(['message' => 'Indemnite kilometrique enregistrée avec succès']);
    }

    public function update(Request $request)
    {
        $this->indemniteKilometriqueService()->store($request->all());
        return response()->json(['message' => 'Indemnite kilometrique mise à jour avec succès']);
    }
}
