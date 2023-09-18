<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;
use App\Models\Transprter;
use Illuminate\Http\Request;
use App\Models\TransprterType;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TransprterStoreRequest;
use App\Http\Requests\TransprterUpdateRequest;

class TransprterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Transprter::class);

        $search = $request->get('search', '');

        $transprters = Transprter::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.transprters.index', compact('transprters', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Transprter::class);

        $orders = Order::pluck('id', 'id');
        $transprterType = TransprterType::pluck('name', 'id');
        return view('app.transprters.create', compact('orders','transprterType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransprterStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Transprter::class);

        $validated = $request->validated();

        $transprter = Transprter::create($validated);

        return redirect()
            ->route('transprters.edit', $transprter)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Transprter $transprter): View
    {
        $this->authorize('view', $transprter);

        return view('app.transprters.show', compact('transprter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Transprter $transprter): View
    {
        $this->authorize('update', $transprter);

        $orders = Order::pluck('id', 'id');

        $transprterType = TransprterType::pluck('name', 'id');
        return view('app.transprters.edit', compact('transprter', 'orders','transprterType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TransprterUpdateRequest $request,
        Transprter $transprter
    ): RedirectResponse {
        $this->authorize('update', $transprter);

        $validated = $request->validated();

        $transprter->update($validated);

        return redirect()
            ->route('transprters.edit', $transprter)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Transprter $transprter
    ): RedirectResponse {
        $this->authorize('delete', $transprter);

        $transprter->delete();

        return redirect()
            ->route('transprters.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
