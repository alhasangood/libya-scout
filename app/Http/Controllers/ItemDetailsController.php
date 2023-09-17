<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\View\View;
use App\Models\ItemDetails;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ItemDetailsStoreRequest;
use App\Http\Requests\ItemDetailsUpdateRequest;

class ItemDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ItemDetails::class);

        $search = $request->get('search', '');

        $allItemDetails = ItemDetails::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.all_item_details.index',
            compact('allItemDetails', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ItemDetails::class);

        $items = Item::pluck('name', 'id');

        return view('app.all_item_details.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemDetailsStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ItemDetails::class);

        $validated = $request->validated();

        $itemDetails = ItemDetails::create($validated);

        return redirect()
            ->route('all-item-details.edit', $itemDetails)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ItemDetails $itemDetails): View
    {
        $this->authorize('view', $itemDetails);

        return view('app.all_item_details.show', compact('itemDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ItemDetails $itemDetails): View
    {
        $this->authorize('update', $itemDetails);

        $items = Item::pluck('name', 'id');

        return view(
            'app.all_item_details.edit',
            compact('itemDetails', 'items')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ItemDetailsUpdateRequest $request,
        ItemDetails $itemDetails
    ): RedirectResponse {
        $this->authorize('update', $itemDetails);

        $validated = $request->validated();

        $itemDetails->update($validated);

        return redirect()
            ->route('all-item-details.edit', $itemDetails)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ItemDetails $itemDetails
    ): RedirectResponse {
        $this->authorize('delete', $itemDetails);

        $itemDetails->delete();

        return redirect()
            ->route('all-item-details.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
