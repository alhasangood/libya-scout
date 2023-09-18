<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScoutRegimentResource;
use App\Http\Resources\ScoutRegimentCollection;

class OrderScoutRegimentsController extends Controller
{
    public function index(
        Request $request,
        Order $order
    ): ScoutRegimentCollection {
        $this->authorize('view', $order);

        $search = $request->get('search', '');

        $scoutRegiments = $order
            ->scoutRegiments()
            ->search($search)
            ->latest()
            ->paginate();

        return new ScoutRegimentCollection($scoutRegiments);
    }

    public function store(Request $request, Order $order): ScoutRegimentResource
    {
        $this->authorize('create', ScoutRegiment::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'phone' => ['required', 'max:255'],
            'status' => ['required', 'max:255'],
            'store_house_id' => ['required', 'exists:store_houses,id'],
        ]);

        $scoutRegiment = $order->scoutRegiments()->create($validated);

        return new ScoutRegimentResource($scoutRegiment);
    }
}
