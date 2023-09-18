<?php

namespace App\Http\Controllers\Api;

use App\Models\StoreHouse;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemCollection;

class StoreHouseItemsController extends Controller
{
    public function index(
        Request $request,
        StoreHouse $storeHouse
    ): ItemCollection {
        $this->authorize('view', $storeHouse);

        $search = $request->get('search', '');

        $items = $storeHouse
            ->items()
            ->search($search)
            ->latest()
            ->paginate();

        return new ItemCollection($items);
    }

    public function store(
        Request $request,
        StoreHouse $storeHouse
    ): ItemResource {
        $this->authorize('create', Item::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $item = $storeHouse->items()->create($validated);

        return new ItemResource($item);
    }
}
