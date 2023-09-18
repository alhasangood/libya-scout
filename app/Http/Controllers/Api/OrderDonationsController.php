<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DonationResource;
use App\Http\Resources\DonationCollection;

class OrderDonationsController extends Controller
{
    public function index(Request $request, Order $order): DonationCollection
    {
        $this->authorize('view', $order);

        $search = $request->get('search', '');

        $donations = $order
            ->donations()
            ->search($search)
            ->latest()
            ->paginate();

        return new DonationCollection($donations);
    }

    public function store(Request $request, Order $order): DonationResource
    {
        $this->authorize('create', Donation::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'status' => ['required', 'max:255'],
            'donation_detales_id' => ['required', 'exists:donation_detales,id'],
        ]);

        $donation = $order->donations()->create($validated);

        return new DonationResource($donation);
    }
}
