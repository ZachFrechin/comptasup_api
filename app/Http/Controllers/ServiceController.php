<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\ServiceCreateRequest;
use App\Http\Requests\Service\ServiceUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Resources\ServiceResource;
use App\Models\Service;

class ServiceController extends Controller
{

    /**
     * Display a listing of the services.
     *
     * @return \Illuminate\Http\JsonResponse The response containing a collection of Service resources.
     */
    public function index()
    {
        return response()->resourceCollection(ServiceResource::collection(Service::all()));
    }

    public function store(ServiceCreateRequest $request)
    {
        $service = Service::create($request->validated());
        return response()->resourceCreated(ServiceResource::make($service));
    }

    /**
     * Display the specified service.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\JsonResponse The response containing the Service resource.
     */
    public function show(Service $service)
    {
        return response()->resource(ServiceResource::make($service));
    }

    public function update(ServiceUpdateRequest $request, Service $service)
    {
        $service->update($request->validated());
        return response()->resourceUpdated(ServiceResource::make($service));
    }

    /**
     * Remove the specified service from storage.
     *
     * @param \App\Models\Service $service The service instance to be deleted.
     * @return \Illuminate\Http\JsonResponse The response confirming the service deletion.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return response()->resourceDeleted();
    }
}
