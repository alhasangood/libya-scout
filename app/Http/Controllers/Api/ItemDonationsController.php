<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DonationResource;
use App\Http\Resources\DonationCollection;

class ItemDonationsController extends Controller
{
    public function index(Request $request, Item $item): DonationCollection
    {
        $this->authorize('view', $item);

        $search = $request->get('search', '');

        $donations = $item
            ->donations()
            ->search($search)
            ->latest()
            ->paginate();

        return new DonationCollection($donations);
    }

    public function store(Request $request, Item $item): DonationResource
    {
        $this->authorize('create', Donation::class);

        $validated = $request->validate([
            'description' => ['required', 'max:255', 'string'],
            'donation_detales_id' => ['required', 'exists:donation_detales,id'],
        ]);

        $donation = $item->donations()->create($validated);

        return new DonationResource($donation);
    }
}
