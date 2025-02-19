<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\ServiceCreateRequest;
use App\Http\Requests\Service\ServiceUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Resources\ServiceResource;
use App\Models\Service;

class ServiceController extends Controller
{

    public function index()
    {
        return response()->resourceCollection(ServiceResource::collection(Service::all()));
    }

    public function store(ServiceCreateRequest $request)
    {
        $service = Service::create($request->validated());
        return response()->resourceCreated(ServiceResource::make($service));
    }

    public function show(Service $service)
    {
        return response()->resource(ServiceResource::make($service));
    }

    public function update(ServiceUpdateRequest $request, Service $service)
    {
        $service->update($request->validated());
        return response()->resourceUpdated(ServiceResource::make($service));
    }
    
    public function destroy(Service $service)
    {
        $service->delete();
        return response()->resourceDeleted();
    }
}
