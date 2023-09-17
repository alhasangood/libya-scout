<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\DonationDetales;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DonationStoreRequest;
use App\Http\Requests\DonationUpdateRequest;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Donation::class);

        $search = $request->get('search', '');

        $donations = Donation::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.donations.index', compact('donations', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Donation::class);

        $allDonationDetales = DonationDetales::pluck('name', 'id');

        return view('app.donations.create', compact('allDonationDetales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DonationStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Donation::class);

        $validated = $request->validated();

        $donation = Donation::create($validated);

        return redirect()
            ->route('donations.edit', $donation)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Donation $donation): View
    {
        $this->authorize('view', $donation);

        return view('app.donations.show', compact('donation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Donation $donation): View
    {
        $this->authorize('update', $donation);

        $allDonationDetales = DonationDetales::pluck('name', 'id');

        return view(
            'app.donations.edit',
            compact('donation', 'allDonationDetales')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        DonationUpdateRequest $request,
        Donation $donation
    ): RedirectResponse {
        $this->authorize('update', $donation);

        $validated = $request->validated();

        $donation->update($validated);

        return redirect()
            ->route('donations.edit', $donation)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Donation $donation
    ): RedirectResponse {
        $this->authorize('delete', $donation);

        $donation->delete();

        return redirect()
            ->route('donations.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
