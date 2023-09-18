<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScoutCommissionResource;
use App\Http\Resources\ScoutCommissionCollection;

class OrderScoutCommissionsController extends Controller
{
    public function index(
        Request $request,
        Order $order
    ): ScoutCommissionCollection {
        $this->authorize('view', $order);

        $search = $request->get('search', '');

        $scoutCommissions = $order
            ->scoutCommissions()
            ->search($search)
            ->latest()
            ->paginate();

        return new ScoutCommissionCollection($scoutCommissions);
    }

    public function store(
        Request $request,
        Order $order
    ): ScoutCommissionResource {
        $this->authorize('create', ScoutCommission::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'phone' => ['required', 'max:255'],
            'status' => ['required', 'max:255'],
            'store_house_id' => ['required', 'exists:store_houses,id'],
            'user_id' => ['required', 'exists:users,id'],
            'scout_regiment_id' => ['required', 'exists:scout_regiments,id'],
        ]);

        $scoutCommission = $order->scoutCommissions()->create($validated);

        return new ScoutCommissionResource($scoutCommission);
    }
}
