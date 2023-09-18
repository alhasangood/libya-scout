<?php

namespace App\Http\Controllers\Api;

use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCollection;

class DonationCategoriesController extends Controller
{
    public function index(
        Request $request,
        Donation $donation
    ): CategoryCollection {
        $this->authorize('view', $donation);

        $search = $request->get('search', '');

        $categories = $donation
            ->categories()
            ->search($search)
            ->latest()
            ->paginate();

        return new CategoryCollection($categories);
    }

    public function store(
        Request $request,
        Donation $donation
    ): CategoryResource {
        $this->authorize('create', Category::class);

        $validated = $request->validate([
            'item_id' => ['required', 'exists:items,id'],
        ]);

        $category = $donation->categories()->create($validated);

        return new CategoryResource($category);
    }
}
