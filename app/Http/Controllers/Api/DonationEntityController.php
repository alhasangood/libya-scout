<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\DonationEntity;
use App\Http\Controllers\Controller;
use App\Http\Resources\DonationEntityResource;
use App\Http\Resources\DonationEntityCollection;
use App\Http\Requests\DonationEntityStoreRequest;
use App\Http\Requests\DonationEntityUpdateRequest;

class DonationEntityController extends Controller
{
    public function index(Request $request): DonationEntityCollection
    {
        $this->authorize('view-any', DonationEntity::class);

        $search = $request->get('search', '');

        $donationEntities = DonationEntity::search($search)
            ->latest()
            ->paginate();

        return new DonationEntityCollection($donationEntities);
    }

    public function store(
        DonationEntityStoreRequest $request
    ): DonationEntityResource {
        $this->authorize('create', DonationEntity::class);

        $validated = $request->validated();

        $donationEntity = DonationEntity::create($validated);

        return new DonationEntityResource($donationEntity);
    }

    public function show(
        Request $request,
        DonationEntity $donationEntity
    ): DonationEntityResource {
        $this->authorize('view', $donationEntity);

        return new DonationEntityResource($donationEntity);
    }

    public function update(
        DonationEntityUpdateRequest $request,
        DonationEntity $donationEntity
    ): DonationEntityResource {
        $this->authorize('update', $donationEntity);

        $validated = $request->validated();

        $donationEntity->update($validated);

        return new DonationEntityResource($donationEntity);
    }

    public function destroy(
        Request $request,
        DonationEntity $donationEntity
    ): Response {
        $this->authorize('delete', $donationEntity);

        $donationEntity->delete();

        return response()->noContent();
    }
}
