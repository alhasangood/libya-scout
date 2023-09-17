<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ScoutCommission;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScoutCommissionResource;
use App\Http\Resources\ScoutCommissionCollection;
use App\Http\Requests\ScoutCommissionStoreRequest;
use App\Http\Requests\ScoutCommissionUpdateRequest;

class ScoutCommissionController extends Controller
{
    public function index(Request $request): ScoutCommissionCollection
    {
        $this->authorize('view-any', ScoutCommission::class);

        $search = $request->get('search', '');

        $scoutCommissions = ScoutCommission::search($search)
            ->latest()
            ->paginate();

        return new ScoutCommissionCollection($scoutCommissions);
    }

    public function store(
        ScoutCommissionStoreRequest $request
    ): ScoutCommissionResource {
        $this->authorize('create', ScoutCommission::class);

        $validated = $request->validated();

        $scoutCommission = ScoutCommission::create($validated);

        return new ScoutCommissionResource($scoutCommission);
    }

    public function show(
        Request $request,
        ScoutCommission $scoutCommission
    ): ScoutCommissionResource {
        $this->authorize('view', $scoutCommission);

        return new ScoutCommissionResource($scoutCommission);
    }

    public function update(
        ScoutCommissionUpdateRequest $request,
        ScoutCommission $scoutCommission
    ): ScoutCommissionResource {
        $this->authorize('update', $scoutCommission);

        $validated = $request->validated();

        $scoutCommission->update($validated);

        return new ScoutCommissionResource($scoutCommission);
    }

    public function destroy(
        Request $request,
        ScoutCommission $scoutCommission
    ): Response {
        $this->authorize('delete', $scoutCommission);

        $scoutCommission->delete();

        return response()->noContent();
    }
}
