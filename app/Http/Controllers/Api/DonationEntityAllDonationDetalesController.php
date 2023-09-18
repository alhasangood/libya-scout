<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\DonationEntity;
use App\Http\Controllers\Controller;
use App\Http\Resources\DonationDetalesResource;
use App\Http\Resources\DonationDetalesCollection;

class DonationEntityAllDonationDetalesController extends Controller
{
    public function index(
        Request $request,
        DonationEntity $donationEntity
    ): DonationDetalesCollection {
        $this->authorize('view', $donationEntity);

        $search = $request->get('search', '');

        $allDonationDetales = $donationEntity
            ->allDonationDetales()
            ->search($search)
            ->latest()
            ->paginate();

        return new DonationDetalesCollection($allDonationDetales);
    }

    public function store(
        Request $request,
        DonationEntity $donationEntity
    ): DonationDetalesResource {
        $this->authorize('create', DonationDetales::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'person' => ['required', 'max:255', 'string'],
            'logo' => ['required', 'max:255'],
            'number' => ['required', 'max:255'],
        ]);

        $donationDetales = $donationEntity
            ->allDonationDetales()
            ->create($validated);

        return new DonationDetalesResource($donationDetales);
    }
}
