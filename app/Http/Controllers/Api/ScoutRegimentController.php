<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ScoutRegiment;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScoutRegimentResource;
use App\Http\Resources\ScoutRegimentCollection;
use App\Http\Requests\ScoutRegimentStoreRequest;
use App\Http\Requests\ScoutRegimentUpdateRequest;

class ScoutRegimentController extends Controller
{
    public function index(Request $request): ScoutRegimentCollection
    {
        $this->authorize('view-any', ScoutRegiment::class);

        $search = $request->get('search', '');

        $scoutRegiments = ScoutRegiment::search($search)
            ->latest()
            ->paginate();

        return new ScoutRegimentCollection($scoutRegiments);
    }

    public function store(
        ScoutRegimentStoreRequest $request
    ): ScoutRegimentResource {
        $this->authorize('create', ScoutRegiment::class);

        $validated = $request->validated();

        $scoutRegiment = ScoutRegiment::create($validated);

        return new ScoutRegimentResource($scoutRegiment);
    }

    public function show(
        Request $request,
        ScoutRegiment $scoutRegiment
    ): ScoutRegimentResource {
        $this->authorize('view', $scoutRegiment);

        return new ScoutRegimentResource($scoutRegiment);
    }

    public function update(
        ScoutRegimentUpdateRequest $request,
        ScoutRegiment $scoutRegiment
    ): ScoutRegimentResource {
        $this->authorize('update', $scoutRegiment);

        $validated = $request->validated();

        $scoutRegiment->update($validated);

        return new ScoutRegimentResource($scoutRegiment);
    }

    public function destroy(
        Request $request,
        ScoutRegiment $scoutRegiment
    ): Response {
        $this->authorize('delete', $scoutRegiment);

        $scoutRegiment->delete();

        return response()->noContent();
    }
}
