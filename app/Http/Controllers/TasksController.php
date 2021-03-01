<?php

namespace App\Http\Controllers;

use App\Http\Resources\TasksResource;
use App\Models\Tasks;
use Illuminate\Http\Request;


class TasksController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks()->paginate(3);

        return TasksResource::collection($tasks);
    }

    public function create(): TasksResource
    {

        $tasks = Tasks::create([
            'user_id'     => auth()->id(),
            'title'       => request('title'),
            'description' => request('description'),
            'completed'   => false,
        ]);

        return new TasksResource($tasks);
    }

//    When putting data as a parameter it allows us to get access to the model in the database
    public function complete(Tasks $tasks)
    {
        if (auth()->id() !== $tasks->user_id) {
            return response()->json([
                'message' => 'you cant do this.',
            ], 401);
        }
        $tasks->completed = !$tasks->completed;
        $tasks->save();

        return new TasksResource($tasks);
    }

    public function edit($id): \Illuminate\Http\JsonResponse
    {
        $tasks = Tasks::findOrFail($id);

        return response()->json($tasks);
    }

    public function update(Tasks $tasks)
    {
        $tasks->update([
            $tasks->title = request('title'),
            $tasks->description = request('description'),
            $tasks->completed = request('completed'),
        ]);
    }

    public function delete(Tasks $tasks): \Illuminate\Http\JsonResponse
    {
        $tasks->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
