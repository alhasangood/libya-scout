<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemDetailsResource;
use App\Http\Resources\ItemDetailsCollection;

class ItemAllItemDetailsController extends Controller
{
    public function index(Request $request, Item $item): ItemDetailsCollection
    {
        $this->authorize('view', $item);

        $search = $request->get('search', '');

        $allItemDetails = $item
            ->allItemDetails()
            ->search($search)
            ->latest()
            ->paginate();

        return new ItemDetailsCollection($allItemDetails);
    }

    public function store(Request $request, Item $item): ItemDetailsResource
    {
        $this->authorize('create', ItemDetails::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'qtuantity' => ['required', 'max:255'],
            'unit' => ['required', 'max:255', 'string'],
        ]);

        $itemDetails = $item->allItemDetails()->create($validated);

        return new ItemDetailsResource($itemDetails);
    }
}
