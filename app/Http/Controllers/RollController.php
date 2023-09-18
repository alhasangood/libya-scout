<?php

namespace App\Http\Controllers;

use App\Models\Roll;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RollStoreRequest;
use App\Http\Requests\RollUpdateRequest;

class RollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Roll::class);

        $search = $request->get('search', '');

        $rolls = Roll::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.rolls.index', compact('rolls', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Roll::class);

        $users = User::pluck('name', 'id');

        return view('app.rolls.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RollStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Roll::class);

        $validated = $request->validated();

        $roll = Roll::create($validated);

        return redirect()
            ->route('rolls.edit', $roll)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Roll $roll): View
    {
        $this->authorize('view', $roll);

        return view('app.rolls.show', compact('roll'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Roll $roll): View
    {
        $this->authorize('update', $roll);

        $users = User::pluck('name', 'id');

        return view('app.rolls.edit', compact('roll', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        RollUpdateRequest $request,
        Roll $roll
    ): RedirectResponse {
        $this->authorize('update', $roll);

        $validated = $request->validated();

        $roll->update($validated);

        return redirect()
            ->route('rolls.edit', $roll)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Roll $roll): RedirectResponse
    {
        $this->authorize('delete', $roll);

        $roll->delete();

        return redirect()
            ->route('rolls.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
