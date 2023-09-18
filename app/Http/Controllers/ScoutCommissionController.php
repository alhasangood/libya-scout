<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\View\View;
use App\Models\StoreHouse;
use Illuminate\Http\Request;
use App\Models\ScoutRegiment;
use App\Models\ScoutCommission;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ScoutCommissionStoreRequest;
use App\Http\Requests\ScoutCommissionUpdateRequest;

class ScoutCommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ScoutCommission::class);

        $search = $request->get('search', '');

        $scoutCommissions = ScoutCommission::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.scout_commissions.index',
            compact('scoutCommissions', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ScoutCommission::class);

        $storeHouses = StoreHouse::pluck('name', 'id');
        $orders = Order::pluck('id', 'id');
        $users = User::pluck('name', 'id');
        $scoutRegiments = ScoutRegiment::pluck('name', 'id');

        return view(
            'app.scout_commissions.create',
            compact('storeHouses', 'orders', 'users', 'scoutRegiments')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        ScoutCommissionStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', ScoutCommission::class);

        $validated = $request->validated();

        $scoutCommission = ScoutCommission::create($validated);

        return redirect()
            ->route('scout-commissions.edit', $scoutCommission)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        ScoutCommission $scoutCommission
    ): View {
        $this->authorize('view', $scoutCommission);

        return view('app.scout_commissions.show', compact('scoutCommission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        ScoutCommission $scoutCommission
    ): View {
        $this->authorize('update', $scoutCommission);

        $storeHouses = StoreHouse::pluck('name', 'id');
        $orders = Order::pluck('id', 'id');
        $users = User::pluck('name', 'id');
        $scoutRegiments = ScoutRegiment::pluck('name', 'id');

        return view(
            'app.scout_commissions.edit',
            compact(
                'scoutCommission',
                'storeHouses',
                'orders',
                'users',
                'scoutRegiments'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ScoutCommissionUpdateRequest $request,
        ScoutCommission $scoutCommission
    ): RedirectResponse {
        $this->authorize('update', $scoutCommission);

        $validated = $request->validated();

        $scoutCommission->update($validated);

        return redirect()
            ->route('scout-commissions.edit', $scoutCommission)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ScoutCommission $scoutCommission
    ): RedirectResponse {
        $this->authorize('delete', $scoutCommission);

        $scoutCommission->delete();

        return redirect()
            ->route('scout-commissions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
