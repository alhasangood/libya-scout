<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransprterResource;
use App\Http\Resources\TransprterCollection;

class OrderTransprtersController extends Controller
{
    public function index(Request $request, Order $order): TransprterCollection
    {
        $this->authorize('view', $order);

        $search = $request->get('search', '');

        $transprters = $order
            ->transprters()
            ->search($search)
            ->latest()
            ->paginate();

        return new TransprterCollection($transprters);
    }

    public function store(Request $request, Order $order): TransprterResource
    {
        $this->authorize('create', Transprter::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'identity' => ['required', 'max:255', 'string'],
            'photo' => ['nullable', 'max:255'],
            'address' => ['required', 'max:255', 'string'],
        ]);

        $transprter = $order->transprters()->create($validated);

        return new TransprterResource($transprter);
    }
}
