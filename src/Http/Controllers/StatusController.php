<?php

namespace HRis\Core\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use HRis\Core\Http\Resources\Status as Resource;
use HRis\Core\Http\Requests\StatusRequest as Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $collection = (new $request->model_type)::orderBy('sort_order');

        if ($this->perPage === 'all') {
            $collection = $collection->get();

            return Resource::collection($collection);
        }

        return Resource::collection($collection->paginate($this->perPage));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Resource
     */
    public function show(Request $request): Resource
    {
        $record = (new $request->model_type)::findOrFail($request->model_id);

        return new Resource($record);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Resource
     */
    public function store(Request $request): Resource
    {
        $data = $request->getData();

        $record = (new $request->model_type)::create($data);

        return new Resource($record);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return Resource
     */
    public function update(Request $request): Resource
    {
        $data = $request->getData();

        $record = (new $request->model_type)::findOrFail($request->model_id);
        $record = (new $request->model_type)::processMovingForward($request, $record);
        $record = tap($record)->update($data);

        return new Resource($record);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $record = (new $request->model_type)::findOrFail($request->model_id);

        $record->delete();

        return response()->json(['status' => trans('core::app.delete_resource_successful')], Response::HTTP_OK);
    }
}
