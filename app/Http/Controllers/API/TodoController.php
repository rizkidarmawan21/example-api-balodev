<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Todo\CreateRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Get all todos
     * 
     * This endpoint retrieves all todos
     */
    public function getAll()
    {
        $todos = Todo::all();
        return response()->json([
            'message' => 'Todos retrieved successfully',
            'data' => $todos
        ]);
    }

    /**
     * Get one todo
     * 
     * This endpoint retrieves a single todo
     * @param int $id The ID of the todo
     */
    public function getOne($id)
    {
        $todo = Todo::find($id);
        if (!$todo) {
            return response()->json([
                'message' => 'Todo not found',
            ], 404);
        }
        return response()->json([
            'message' => 'Todo retrieved successfully',
            'data' => $todo
        ]);
    }

    /**
     * Create a todo
     * 
     * This endpoint creates a new todo
     * @param string $task_name The name of the task
     * @param boolean $is_completed The completion status of the task
     */
    public function create(CreateRequest $request)
    {
        $todo = Todo::create($request->all());
        return response()->json([
            'message' => 'Todo created successfully',
            'data' => $todo
        ], 201);
    }

    /**
     * Update a todo
     * 
     * This endpoint updates a todo
     * @param int $id The ID of the todo
     */
    public function update(CreateRequest $request, $id)
    {
        $todo = Todo::find($id);
        if (!$todo) {
            return response()->json([
                'message' => 'Todo not found',
            ], 404);
        }

        $todo->update($request->all());
        return response()->json([
            'message' => 'Todo updated successfully',
            'data' => $todo
        ]);
    }

    public function delete($id)
    {
        $todo = Todo::find($id);
        if (!$todo) {
            return response()->json([
                'message' => 'Todo not found',
            ], 404);
        }

        $todo->delete();
        return response()->json([
            'message' => 'Todo deleted successfully',
        ]);
    }

    public function complete(Request $request, $id)
    {
        $todo = Todo::find($id);
        if (!$todo) {
            return response()->json([
                'message' => 'Todo not found',
            ], 404);
        }

        $request->validate([
            'is_completed' => 'required|boolean'
        ]);


        $todo->update(['is_completed' => $request->is_completed]);
        return response()->json([
            'message' => 'Todo completed successfully',
            'data' => $todo
        ]);
    }
}
