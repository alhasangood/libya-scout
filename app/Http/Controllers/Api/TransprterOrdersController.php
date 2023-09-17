<?php

namespace App\Http\Controllers\Api;

use App\Models\Transprter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;

class TransprterOrdersController extends Controller
{
    public function index(
        Request $request,
        Transprter $transprter
    ): OrderCollection {
        $this->authorize('view', $transprter);

        $search = $request->get('search', '');

        $orders = $transprter
            ->orders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderCollection($orders);
    }

    public function store(
        Request $request,
        Transprter $transprter
    ): OrderResource {
        $this->authorize('create', Order::class);

        $validated = $request->validate([
            'orederNumber' => ['required', 'max:255'],
        ]);

        $order = $transprter->orders()->create($validated);

        return new OrderResource($order);
    }
}
