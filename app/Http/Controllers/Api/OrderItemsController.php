<?php
namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemCollection;

class OrderItemsController extends Controller
{
    public function index(Request $request, Order $order): ItemCollection
    {
        $this->authorize('view', $order);

        $search = $request->get('search', '');

        $items = $order
            ->items()
            ->search($search)
            ->latest()
            ->paginate();

        return new ItemCollection($items);
    }

    public function store(Request $request, Order $order, Item $item): Response
    {
        $this->authorize('update', $order);

        $order->items()->syncWithoutDetaching([$item->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Order $order,
        Item $item
    ): Response {
        $this->authorize('update', $order);

        $order->items()->detach($item);

        return response()->noContent();
    }
}
