<?php
namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;

class ItemOrdersController extends Controller
{
    public function index(Request $request, Item $item): OrderCollection
    {
        $this->authorize('view', $item);

        $search = $request->get('search', '');

        $orders = $item
            ->orders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderCollection($orders);
    }

    public function store(Request $request, Item $item, Order $order): Response
    {
        $this->authorize('update', $item);

        $item->orders()->syncWithoutDetaching([$order->orederNumber]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Item $item,
        Order $order
    ): Response {
        $this->authorize('update', $item);

        $item->orders()->detach($order);

        return response()->noContent();
    }
}
