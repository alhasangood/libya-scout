<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\TransprterType;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransprterTypeResource;
use App\Http\Resources\TransprterTypeCollection;
use App\Http\Requests\TransprterTypeStoreRequest;
use App\Http\Requests\TransprterTypeUpdateRequest;

class TransprterTypeController extends Controller
{
    public function index(Request $request): TransprterTypeCollection
    {
        $this->authorize('view-any', TransprterType::class);

        $search = $request->get('search', '');

        $transprterTypes = TransprterType::search($search)
            ->latest()
            ->paginate();

        return new TransprterTypeCollection($transprterTypes);
    }

    public function store(
        TransprterTypeStoreRequest $request
    ): TransprterTypeResource {
        $this->authorize('create', TransprterType::class);

        $validated = $request->validated();

        $transprterType = TransprterType::create($validated);

        return new TransprterTypeResource($transprterType);
    }

    public function show(
        Request $request,
        TransprterType $transprterType
    ): TransprterTypeResource {
        $this->authorize('view', $transprterType);

        return new TransprterTypeResource($transprterType);
    }

    public function update(
        TransprterTypeUpdateRequest $request,
        TransprterType $transprterType
    ): TransprterTypeResource {
        $this->authorize('update', $transprterType);

        $validated = $request->validated();

        $transprterType->update($validated);

        return new TransprterTypeResource($transprterType);
    }

    public function destroy(
        Request $request,
        TransprterType $transprterType
    ): Response {
        $this->authorize('delete', $transprterType);

        $transprterType->delete();

        return response()->noContent();
    }
}
