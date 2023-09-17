<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ScoutCommission;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScoutRegimentResource;
use App\Http\Resources\ScoutRegimentCollection;

class ScoutCommissionScoutRegimentsController extends Controller
{
    public function index(
        Request $request,
        ScoutCommission $scoutCommission
    ): ScoutRegimentCollection {
        $this->authorize('view', $scoutCommission);

        $search = $request->get('search', '');

        $scoutRegiments = $scoutCommission
            ->scoutRegiments()
            ->search($search)
            ->latest()
            ->paginate();

        return new ScoutRegimentCollection($scoutRegiments);
    }

    public function store(
        Request $request,
        ScoutCommission $scoutCommission
    ): ScoutRegimentResource {
        $this->authorize('create', ScoutRegiment::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'phone_number' => ['required', 'max:255'],
        ]);

        $scoutRegiment = $scoutCommission->scoutRegiments()->create($validated);

        return new ScoutRegimentResource($scoutRegiment);
    }
}
