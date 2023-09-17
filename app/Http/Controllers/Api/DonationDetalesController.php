<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\DonationDetales;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\DonationDetalesResource;
use App\Http\Resources\DonationDetalesCollection;
use App\Http\Requests\DonationDetalesStoreRequest;
use App\Http\Requests\DonationDetalesUpdateRequest;

class DonationDetalesController extends Controller
{
    public function index(Request $request): DonationDetalesCollection
    {
        $this->authorize('view-any', DonationDetales::class);

        $search = $request->get('search', '');

        $allDonationDetales = DonationDetales::search($search)
            ->latest()
            ->paginate();

        return new DonationDetalesCollection($allDonationDetales);
    }

    public function store(
        DonationDetalesStoreRequest $request
    ): DonationDetalesResource {
        $this->authorize('create', DonationDetales::class);

        $validated = $request->validated();
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('public');
        }

        $donationDetales = DonationDetales::create($validated);

        return new DonationDetalesResource($donationDetales);
    }

    public function show(
        Request $request,
        DonationDetales $donationDetales
    ): DonationDetalesResource {
        $this->authorize('view', $donationDetales);

        return new DonationDetalesResource($donationDetales);
    }

    public function update(
        DonationDetalesUpdateRequest $request,
        DonationDetales $donationDetales
    ): DonationDetalesResource {
        $this->authorize('update', $donationDetales);

        $validated = $request->validated();

        if ($request->hasFile('logo')) {
            if ($donationDetales->logo) {
                Storage::delete($donationDetales->logo);
            }

            $validated['logo'] = $request->file('logo')->store('public');
        }

        $donationDetales->update($validated);

        return new DonationDetalesResource($donationDetales);
    }

    public function destroy(
        Request $request,
        DonationDetales $donationDetales
    ): Response {
        $this->authorize('delete', $donationDetales);

        if ($donationDetales->logo) {
            Storage::delete($donationDetales->logo);
        }

        $donationDetales->delete();

        return response()->noContent();
    }
}
