<?php
namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\StoreHouse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\StoreHouseCollection;

class OrderStoreHousesController extends Controller
{
    public function index(Request $request, Order $order): StoreHouseCollection
    {
        $this->authorize('view', $order);

        $search = $request->get('search', '');

        $storeHouses = $order
            ->storeHouses()
            ->search($search)
            ->latest()
            ->paginate();

        return new StoreHouseCollection($storeHouses);
    }

    public function store(
        Request $request,
        Order $order,
        StoreHouse $storeHouse
    ): Response {
        $this->authorize('update', $order);

        $order->storeHouses()->syncWithoutDetaching([$storeHouse->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Order $order,
        StoreHouse $storeHouse
    ): Response {
        $this->authorize('update', $order);

        $order->storeHouses()->detach($storeHouse);

        return response()->noContent();
    }
}
