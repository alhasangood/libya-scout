<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCollection;

class ItemCategoriesController extends Controller
{
    public function index(Request $request, Item $item): CategoryCollection
    {
        $this->authorize('view', $item);

        $search = $request->get('search', '');

        $categories = $item
            ->categories()
            ->search($search)
            ->latest()
            ->paginate();

        return new CategoryCollection($categories);
    }

    public function store(Request $request, Item $item): CategoryResource
    {
        $this->authorize('create', Category::class);

        $validated = $request->validate([
            'donation_id' => ['required', 'exists:donations,id'],
        ]);

        $category = $item->categories()->create($validated);

        return new CategoryResource($category);
    }
}
