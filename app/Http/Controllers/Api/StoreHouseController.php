<?php

namespace App\Http\Controllers\Api;

use App\Models\StoreHouse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\StoreHouseResource;
use App\Http\Resources\StoreHouseCollection;
use App\Http\Requests\StoreHouseStoreRequest;
use App\Http\Requests\StoreHouseUpdateRequest;

class StoreHouseController extends Controller
{
    public function index(Request $request): StoreHouseCollection
    {
        $this->authorize('view-any', StoreHouse::class);

        $search = $request->get('search', '');

        $storeHouses = StoreHouse::search($search)
            ->latest()
            ->paginate();

        return new StoreHouseCollection($storeHouses);
    }

    public function store(StoreHouseStoreRequest $request): StoreHouseResource
    {
        $this->authorize('create', StoreHouse::class);

        $validated = $request->validated();

        $storeHouse = StoreHouse::create($validated);

        return new StoreHouseResource($storeHouse);
    }

    public function show(
        Request $request,
        StoreHouse $storeHouse
    ): StoreHouseResource {
        $this->authorize('view', $storeHouse);

        return new StoreHouseResource($storeHouse);
    }

    public function update(
        StoreHouseUpdateRequest $request,
        StoreHouse $storeHouse
    ): StoreHouseResource {
        $this->authorize('update', $storeHouse);

        $validated = $request->validated();

        $storeHouse->update($validated);

        return new StoreHouseResource($storeHouse);
    }

    public function destroy(Request $request, StoreHouse $storeHouse): Response
    {
        $this->authorize('delete', $storeHouse);

        $storeHouse->delete();

        return response()->noContent();
    }
}
