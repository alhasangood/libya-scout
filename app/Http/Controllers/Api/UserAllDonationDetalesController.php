<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DonationDetalesResource;
use App\Http\Resources\DonationDetalesCollection;

class UserAllDonationDetalesController extends Controller
{
    public function index(
        Request $request,
        User $user
    ): DonationDetalesCollection {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $allDonationDetales = $user
            ->allDonationDetales()
            ->search($search)
            ->latest()
            ->paginate();

        return new DonationDetalesCollection($allDonationDetales);
    }

    public function store(Request $request, User $user): DonationDetalesResource
    {
        $this->authorize('create', DonationDetales::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'person' => ['required', 'max:255', 'string'],
            'phone_number' => ['required', 'max:255'],
            'donation_entity_id' => ['required', 'exists:donation_entities,id'],
            'logo' => ['image', 'max:1024', 'required'],
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('public');
        }

        $donationDetales = $user->allDonationDetales()->create($validated);

        return new DonationDetalesResource($donationDetales);
    }
}
