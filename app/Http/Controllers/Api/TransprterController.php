<?php

namespace App\Http\Controllers\Api;

use App\Models\Transprter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\TransprterResource;
use App\Http\Resources\TransprterCollection;
use App\Http\Requests\TransprterStoreRequest;
use App\Http\Requests\TransprterUpdateRequest;

class TransprterController extends Controller
{
    public function index(Request $request): TransprterCollection
    {
        $this->authorize('view-any', Transprter::class);

        $search = $request->get('search', '');

        $transprters = Transprter::search($search)
            ->latest()
            ->paginate();

        return new TransprterCollection($transprters);
    }

    public function store(TransprterStoreRequest $request): TransprterResource
    {
        $this->authorize('create', Transprter::class);

        $validated = $request->validated();
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('public');
        }

        $transprter = Transprter::create($validated);

        return new TransprterResource($transprter);
    }

    public function show(
        Request $request,
        Transprter $transprter
    ): TransprterResource {
        $this->authorize('view', $transprter);

        return new TransprterResource($transprter);
    }

    public function update(
        TransprterUpdateRequest $request,
        Transprter $transprter
    ): TransprterResource {
        $this->authorize('update', $transprter);

        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            if ($transprter->photo) {
                Storage::delete($transprter->photo);
            }

            $validated['photo'] = $request->file('photo')->store('public');
        }

        $transprter->update($validated);

        return new TransprterResource($transprter);
    }

    public function destroy(Request $request, Transprter $transprter): Response
    {
        $this->authorize('delete', $transprter);

        if ($transprter->photo) {
            Storage::delete($transprter->photo);
        }

        $transprter->delete();

        return response()->noContent();
    }
}
