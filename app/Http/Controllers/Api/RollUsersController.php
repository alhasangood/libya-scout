<?php

namespace App\Http\Controllers\Api;

use App\Models\Roll;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;

class RollUsersController extends Controller
{
    public function index(Request $request, Roll $roll): UserCollection
    {
        $this->authorize('view', $roll);

        $search = $request->get('search', '');

        $users = $roll
            ->users()
            ->search($search)
            ->latest()
            ->paginate();

        return new UserCollection($users);
    }

    public function store(Request $request, Roll $roll): UserResource
    {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'unique:users,email', 'email'],
            'password' => ['required'],
            'phone _number' => ['required', 'max:255', 'string'],
            'userable_type' => ['required', 'max:255', 'string'],
            'userable_id' => ['required', 'max:255'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = $roll->users()->create($validated);

        $user->syncRoles($request->roles);

        return new UserResource($user);
    }
}
