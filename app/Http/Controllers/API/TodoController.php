<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function getAll()
    {
        $todos = Todo::all();
        return response()->json([
            'message' => 'Todos retrieved successfully',
            'data' => $todos
        ]);
    }

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

    public function create(Request $request)
    {
        $request->validate([
            'task_name' => 'required',
            'is_completed' => 'required|boolean'
        ]);

        $todo = Todo::create($request->all());
        return response()->json([
            'message' => 'Todo created successfully',
            'data' => $todo
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);
        if (!$todo) {
            return response()->json([
                'message' => 'Todo not found',
            ], 404);
        }

        $request->validate([
            'task_name' => 'required',
            'is_completed' => 'required|boolean'
        ]);


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
