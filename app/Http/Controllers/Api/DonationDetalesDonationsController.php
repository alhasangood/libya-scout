<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\DonationDetales;
use App\Http\Controllers\Controller;
use App\Http\Resources\DonationResource;
use App\Http\Resources\DonationCollection;

class DonationDetalesDonationsController extends Controller
{
    public function index(
        Request $request,
        DonationDetales $donationDetales
    ): DonationCollection {
        $this->authorize('view', $donationDetales);

        $search = $request->get('search', '');

        $donations = $donationDetales
            ->donations()
            ->search($search)
            ->latest()
            ->paginate();

        return new DonationCollection($donations);
    }

    public function store(
        Request $request,
        DonationDetales $donationDetales
    ): DonationResource {
        $this->authorize('create', Donation::class);

        $validated = $request->validate([
            'description' => ['required', 'max:255', 'string'],
        ]);

        $donation = $donationDetales->donations()->create($validated);

        return new DonationResource($donation);
    }
}
