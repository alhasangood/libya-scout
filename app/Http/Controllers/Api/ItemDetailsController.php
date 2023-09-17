<?php

namespace App\Http\Controllers\Api;

use App\Models\ItemDetails;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemDetailsResource;
use App\Http\Resources\ItemDetailsCollection;
use App\Http\Requests\ItemDetailsStoreRequest;
use App\Http\Requests\ItemDetailsUpdateRequest;

class ItemDetailsController extends Controller
{
    public function index(Request $request): ItemDetailsCollection
    {
        $this->authorize('view-any', ItemDetails::class);

        $search = $request->get('search', '');

        $allItemDetails = ItemDetails::search($search)
            ->latest()
            ->paginate();

        return new ItemDetailsCollection($allItemDetails);
    }

    public function store(ItemDetailsStoreRequest $request): ItemDetailsResource
    {
        $this->authorize('create', ItemDetails::class);

        $validated = $request->validated();

        $itemDetails = ItemDetails::create($validated);

        return new ItemDetailsResource($itemDetails);
    }

    public function show(
        Request $request,
        ItemDetails $itemDetails
    ): ItemDetailsResource {
        $this->authorize('view', $itemDetails);

        return new ItemDetailsResource($itemDetails);
    }

    public function update(
        ItemDetailsUpdateRequest $request,
        ItemDetails $itemDetails
    ): ItemDetailsResource {
        $this->authorize('update', $itemDetails);

        $validated = $request->validated();

        $itemDetails->update($validated);

        return new ItemDetailsResource($itemDetails);
    }

    public function destroy(
        Request $request,
        ItemDetails $itemDetails
    ): Response {
        $this->authorize('delete', $itemDetails);

        $itemDetails->delete();

        return response()->noContent();
    }
}
