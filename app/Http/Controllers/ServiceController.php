<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceCreateRequest;
use App\Http\Requests\ServiceUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(["data" => Service::all()] ,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceCreateRequest $request)
    {
        $service = Service::create($request->validated());
        return response()->json(["data"=> $service ] ,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return response()->json(["data" => $service] ,200);
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
    public function update(ServiceUpdateRequest $request, Service $service)
    {
        $service->update($request->validated());
        return response()->json(["data" => $service] ,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json(["data"=> "ok" ] ,200);
    }
}
