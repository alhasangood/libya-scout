<?php

namespace App\Http\Controllers\Api;

use App\Models\StoreHouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DonationResource;
use App\Http\Resources\DonationCollection;

class StoreHouseDonationsController extends Controller
{
    public function index(
        Request $request,
        StoreHouse $storeHouse
    ): DonationCollection {
        $this->authorize('view', $storeHouse);

        $search = $request->get('search', '');

        $donations = $storeHouse
            ->donations()
            ->search($search)
            ->latest()
            ->paginate();

        return new DonationCollection($donations);
    }

    public function store(
        Request $request,
        StoreHouse $storeHouse
    ): DonationResource {
        $this->authorize('create', Donation::class);

        $validated = $request->validate([
            'description' => ['required', 'max:255', 'string'],
            'donation_detales_id' => ['required', 'exists:donation_detales,id'],
        ]);

        $donation = $storeHouse->donations()->create($validated);

        return new DonationResource($donation);
    }
}
