<?php
namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\StoreHouse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;

class StoreHouseOrdersController extends Controller
{
    public function index(
        Request $request,
        StoreHouse $storeHouse
    ): OrderCollection {
        $this->authorize('view', $storeHouse);

        $search = $request->get('search', '');

        $orders = $storeHouse
            ->orders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderCollection($orders);
    }

    public function store(
        Request $request,
        StoreHouse $storeHouse,
        Order $order
    ): Response {
        $this->authorize('update', $storeHouse);

        $storeHouse->orders()->syncWithoutDetaching([$order->orederNumber]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        StoreHouse $storeHouse,
        Order $order
    ): Response {
        $this->authorize('update', $storeHouse);

        $storeHouse->orders()->detach($order);

        return response()->noContent();
    }
}
