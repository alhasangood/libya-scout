<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ScoutRegiment;
use App\Models\ScoutCommission;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ScoutRegimentStoreRequest;
use App\Http\Requests\ScoutRegimentUpdateRequest;

class ScoutRegimentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ScoutRegiment::class);

        $search = $request->get('search', '');

        $scoutRegiments = ScoutRegiment::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.scout_regiments.index',
            compact('scoutRegiments', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ScoutRegiment::class);

        $scoutCommissions = ScoutCommission::pluck('name', 'id');

        return view('app.scout_regiments.create', compact('scoutCommissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ScoutRegimentStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ScoutRegiment::class);

        $validated = $request->validated();

        $scoutRegiment = ScoutRegiment::create($validated);

        return redirect()
            ->route('scout-regiments.edit', $scoutRegiment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ScoutRegiment $scoutRegiment): View
    {
        $this->authorize('view', $scoutRegiment);

        return view('app.scout_regiments.show', compact('scoutRegiment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ScoutRegiment $scoutRegiment): View
    {
        $this->authorize('update', $scoutRegiment);

        $scoutCommissions = ScoutCommission::pluck('name', 'id');

        return view(
            'app.scout_regiments.edit',
            compact('scoutRegiment', 'scoutCommissions')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ScoutRegimentUpdateRequest $request,
        ScoutRegiment $scoutRegiment
    ): RedirectResponse {
        $this->authorize('update', $scoutRegiment);

        $validated = $request->validated();

        $scoutRegiment->update($validated);

        return redirect()
            ->route('scout-regiments.edit', $scoutRegiment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ScoutRegiment $scoutRegiment
    ): RedirectResponse {
        $this->authorize('delete', $scoutRegiment);

        $scoutRegiment->delete();

        return redirect()
            ->route('scout-regiments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
