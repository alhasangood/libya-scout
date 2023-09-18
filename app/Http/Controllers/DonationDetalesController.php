<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\DonationEntity;
use App\Models\DonationDetales;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DonationDetalesStoreRequest;
use App\Http\Requests\DonationDetalesUpdateRequest;

class DonationDetalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', DonationDetales::class);

        $search = $request->get('search', '');

        $allDonationDetales = DonationDetales::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.all_donation_detales.index',
            compact('allDonationDetales', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', DonationDetales::class);

        $donationEntities = DonationEntity::pluck('name', 'id');

        return view(
            'app.all_donation_detales.create',
            compact('donationEntities')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        DonationDetalesStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', DonationDetales::class);

        $validated = $request->validated();

        $donationDetales = DonationDetales::create($validated);

        return redirect()
            ->route('all-donation-detales.edit', $donationDetales)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        DonationDetales $donationDetales
    ): View {
        $this->authorize('view', $donationDetales);

        return view(
            'app.all_donation_detales.show',
            compact('donationDetales')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        DonationDetales $donationDetales
    ): View {
        $this->authorize('update', $donationDetales);

        $donationEntities = DonationEntity::pluck('name', 'id');

        return view(
            'app.all_donation_detales.edit',
            compact('donationDetales', 'donationEntities')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        DonationDetalesUpdateRequest $request,
        DonationDetales $donationDetales
    ): RedirectResponse {
        $this->authorize('update', $donationDetales);

        $validated = $request->validated();

        $donationDetales->update($validated);

        return redirect()
            ->route('all-donation-detales.edit', $donationDetales)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        DonationDetales $donationDetales
    ): RedirectResponse {
        $this->authorize('delete', $donationDetales);

        $donationDetales->delete();

        return redirect()
            ->route('all-donation-detales.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
