<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\DonationEntity;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DonationEntityStoreRequest;
use App\Http\Requests\DonationEntityUpdateRequest;

class DonationEntityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', DonationEntity::class);

        $search = $request->get('search', '');

        $donationEntities = DonationEntity::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.donation_entities.index',
            compact('donationEntities', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', DonationEntity::class);

        return view('app.donation_entities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DonationEntityStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', DonationEntity::class);

        $validated = $request->validated();

        $donationEntity = DonationEntity::create($validated);

        return redirect()
            ->route('donation-entities.edit', $donationEntity)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, DonationEntity $donationEntity): View
    {
        $this->authorize('view', $donationEntity);

        return view('app.donation_entities.show', compact('donationEntity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, DonationEntity $donationEntity): View
    {
        $this->authorize('update', $donationEntity);

        return view('app.donation_entities.edit', compact('donationEntity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        DonationEntityUpdateRequest $request,
        DonationEntity $donationEntity
    ): RedirectResponse {
        $this->authorize('update', $donationEntity);

        $validated = $request->validated();

        $donationEntity->update($validated);

        return redirect()
            ->route('donation-entities.edit', $donationEntity)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        DonationEntity $donationEntity
    ): RedirectResponse {
        $this->authorize('delete', $donationEntity);

        $donationEntity->delete();

        return redirect()
            ->route('donation-entities.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
