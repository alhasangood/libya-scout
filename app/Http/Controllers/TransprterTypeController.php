<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Transprter;
use Illuminate\Http\Request;
use App\Models\TransprterType;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TransprterTypeStoreRequest;
use App\Http\Requests\TransprterTypeUpdateRequest;

class TransprterTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', TransprterType::class);

        $search = $request->get('search', '');

        $transprterTypes = TransprterType::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.transprter_types.index',
            compact('transprterTypes', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', TransprterType::class);

    

        return view('app.transprter_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransprterTypeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', TransprterType::class);

        $validated = $request->validated();

        $transprterType = TransprterType::create($validated);

        return redirect()
            ->route('transprter-types.edit', $transprterType)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, TransprterType $transprterType): View
    {
        $this->authorize('view', $transprterType);

        return view('app.transprter_types.show', compact('transprterType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, TransprterType $transprterType): View
    {
        $this->authorize('update', $transprterType);

       
        return view(
            'app.transprter_types.edit',
            compact('transprterType', )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TransprterTypeUpdateRequest $request,
        TransprterType $transprterType
    ): RedirectResponse {
        $this->authorize('update', $transprterType);

        $validated = $request->validated();

        $transprterType->update($validated);

        return redirect()
            ->route('transprter-types.edit', $transprterType)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        TransprterType $transprterType
    ): RedirectResponse {
        $this->authorize('delete', $transprterType);

        $transprterType->delete();

        return redirect()
            ->route('transprter-types.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
