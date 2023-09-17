<?php

namespace App\Http\Controllers\Api;

use App\Models\Roll;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\RollResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\RollCollection;
use App\Http\Requests\RollStoreRequest;
use App\Http\Requests\RollUpdateRequest;

class RollController extends Controller
{
    public function index(Request $request): RollCollection
    {
        $this->authorize('view-any', Roll::class);

        $search = $request->get('search', '');

        $rolls = Roll::search($search)
            ->latest()
            ->paginate();

        return new RollCollection($rolls);
    }

    public function store(RollStoreRequest $request): RollResource
    {
        $this->authorize('create', Roll::class);

        $validated = $request->validated();

        $roll = Roll::create($validated);

        return new RollResource($roll);
    }

    public function show(Request $request, Roll $roll): RollResource
    {
        $this->authorize('view', $roll);

        return new RollResource($roll);
    }

    public function update(RollUpdateRequest $request, Roll $roll): RollResource
    {
        $this->authorize('update', $roll);

        $validated = $request->validated();

        $roll->update($validated);

        return new RollResource($roll);
    }

    public function destroy(Request $request, Roll $roll): Response
    {
        $this->authorize('delete', $roll);

        $roll->delete();

        return response()->noContent();
    }
}
