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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
