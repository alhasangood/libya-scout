<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\StoreHouse;
use Illuminate\Http\Request;
use App\Models\ScoutRegiment;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreHouseStoreRequest;
use App\Http\Requests\StoreHouseUpdateRequest;

class StoreHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', StoreHouse::class);

        $search = $request->get('search', '');

        $storeHouses = StoreHouse::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.store_houses.index', compact('storeHouses', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', StoreHouse::class);
        $scoutRegiments = ScoutRegiment::pluck('name', 'id');
        return view('app.store_houses.create' ,compact('scoutRegiments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHouseStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', StoreHouse::class);

        $validated = $request->validated();

        $storeHouse = StoreHouse::create($validated);

        return redirect()
            ->route('store-houses.edit', $storeHouse)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, StoreHouse $storeHouse): View
    {
        $this->authorize('view', $storeHouse);

        return view('app.store_houses.show', compact('storeHouse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, StoreHouse $storeHouse): View
    {
        $this->authorize('update', $storeHouse);
        $scoutRegiments = ScoutRegiment::pluck('name', 'id');
        return view('app.store_houses.edit', compact('storeHouse','scoutRegiments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        StoreHouseUpdateRequest $request,
        StoreHouse $storeHouse
    ): RedirectResponse {
        $this->authorize('update', $storeHouse);

        $validated = $request->validated();

        $storeHouse->update($validated);

        return redirect()
            ->route('store-houses.edit', $storeHouse)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        StoreHouse $storeHouse
    ): RedirectResponse {
        $this->authorize('delete', $storeHouse);

        $storeHouse->delete();

        return redirect()
            ->route('store-houses.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
