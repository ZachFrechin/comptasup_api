<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceCreateRequest;
use App\Http\Requests\ServiceUpdateRequest;
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

    /**
     * Store a newly created service in storage.
     *
     * @param  \App\Http\Requests\ServiceCreateRequest  $request
     * @return \Illuminate\Http\JsonResponse The response containing the newly created Service resource.
     */
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

    /**
     * Update the specified service in storage.
     *
     * @param  \App\Http\Requests\ServiceUpdateRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\JsonResponse The response containing the updated Service resource.
     */
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
