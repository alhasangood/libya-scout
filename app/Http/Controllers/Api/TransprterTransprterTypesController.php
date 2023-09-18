<?php

namespace App\Http\Controllers\Api;

use App\Models\Transprter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransprterTypeResource;
use App\Http\Resources\TransprterTypeCollection;

class TransprterTransprterTypesController extends Controller
{
    public function index(
        Request $request,
        Transprter $transprter
    ): TransprterTypeCollection {
        $this->authorize('view', $transprter);

        $search = $request->get('search', '');

        $transprterTypes = $transprter
            ->transprterTypes()
            ->search($search)
            ->latest()
            ->paginate();

        return new TransprterTypeCollection($transprterTypes);
    }

    public function store(
        Request $request,
        Transprter $transprter
    ): TransprterTypeResource {
        $this->authorize('create', TransprterType::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'status' => ['required', 'max:255'],
        ]);

        $transprterType = $transprter->transprterTypes()->create($validated);

        return new TransprterTypeResource($transprterType);
    }
}
