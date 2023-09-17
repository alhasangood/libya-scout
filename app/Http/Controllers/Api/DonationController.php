<?php

namespace App\Http\Controllers\Api;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\DonationResource;
use App\Http\Resources\DonationCollection;
use App\Http\Requests\DonationStoreRequest;
use App\Http\Requests\DonationUpdateRequest;

class DonationController extends Controller
{
    public function index(Request $request): DonationCollection
    {
        $this->authorize('view-any', Donation::class);

        $search = $request->get('search', '');

        $donations = Donation::search($search)
            ->latest()
            ->paginate();

        return new DonationCollection($donations);
    }

    public function store(DonationStoreRequest $request): DonationResource
    {
        $this->authorize('create', Donation::class);

        $validated = $request->validated();

        $donation = Donation::create($validated);

        return new DonationResource($donation);
    }

    public function show(Request $request, Donation $donation): DonationResource
    {
        $this->authorize('view', $donation);

        return new DonationResource($donation);
    }

    public function update(
        DonationUpdateRequest $request,
        Donation $donation
    ): DonationResource {
        $this->authorize('update', $donation);

        $validated = $request->validated();

        $donation->update($validated);

        return new DonationResource($donation);
    }

    public function destroy(Request $request, Donation $donation): Response
    {
        $this->authorize('delete', $donation);

        $donation->delete();

        return response()->noContent();
    }
}
