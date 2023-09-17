<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\TransprterType;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransprterResource;
use App\Http\Resources\TransprterCollection;

class TransprterTypeTransprtersController extends Controller
{
    public function index(
        Request $request,
        TransprterType $transprterType
    ): TransprterCollection {
        $this->authorize('view', $transprterType);

        $search = $request->get('search', '');

        $transprters = $transprterType
            ->transprters()
            ->search($search)
            ->latest()
            ->paginate();

        return new TransprterCollection($transprters);
    }

    public function store(
        Request $request,
        TransprterType $transprterType
    ): TransprterResource {
        $this->authorize('create', Transprter::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'identity' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'photo' => ['image', 'max:1024', 'nullable'],
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('public');
        }

        $transprter = $transprterType->transprters()->create($validated);

        return new TransprterResource($transprter);
    }
}
