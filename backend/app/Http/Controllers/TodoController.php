<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TodoController extends Controller
{
    public function index(): JsonResponse
    {
        $todos = Todo::all();
        return response()->json($todos);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'completed' => 'boolean'
        ]);

        $todo = Todo::create($validated);
        return response()->json($todo, 201);
    }

    public function show(Todo $todo): JsonResponse
    {
        return response()->json($todo);
    }

    public function update(Request $request, Todo $todo): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'completed' => 'sometimes|boolean'
        ]);

        $todo->update($validated);
        return response()->json($todo);
    }

    public function destroy(Todo $todo): JsonResponse
    {
        $todo->delete();
        return response()->json(null, 204);
    }
}
