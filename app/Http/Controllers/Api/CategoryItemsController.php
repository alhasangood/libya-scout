<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemCollection;

class CategoryItemsController extends Controller
{
    public function index(Request $request, Category $category): ItemCollection
    {
        $this->authorize('view', $category);

        $search = $request->get('search', '');

        $items = $category
            ->items()
            ->search($search)
            ->latest()
            ->paginate();

        return new ItemCollection($items);
    }

    public function store(Request $request, Category $category): ItemResource
    {
        $this->authorize('create', Item::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $item = $category->items()->create($validated);

        return new ItemResource($item);
    }
}
