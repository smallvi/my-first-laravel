<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Todo List - CRUD (Ajax) Test';
        // $todos = Todo::all();
        // return view('todos.index', compact(['todos', 'title']));

        if ($request->ajax()) {
            $data = Todo::where('is_active', '1')->select('id', 'todo', 'updated_at')->get();
            return DataTables::of($data)
                ->addColumn('action', 'todos.todo-action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        Log::info("View todo list");
        return view('todos.todo', compact(['title']));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {

    //     $title = 'Create New Todo - CRUD test';
    //     return view('todos.create', compact(['title']));
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoRequest $request)
    {
        // $request->validate([
        //     'todo' => 'required',
        // ]);

        // $todo = new Todo();
        // $todo->is_active = 1;
        // $todo->todo = $request->todo;
        // $todo->save();
        // return redirect()->route('todos.index')->with('success', 'Todo has been created successfully');

        $validatedData = $request->validated();

        $todo   =   Todo::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'todo' => $request->todo,
                'is_active' => 1,
            ]
        );

        if ($request->id) {
            Log::info("ID: {$request->id} updated successfully");
        } else {
            Log::info("ID: {$todo->id} created successfully");
        }


        return Response()->json($todo);
    }

    /**
     * Display the specified resource.
     */
    // public function show(Todo $todo)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        // $title = "Edit Todo";
        // return view('todos.edit', compact(['todo', 'title']));

        $where = array('id' => $request->id);
        $todo  = Todo::where($where)->first();

        return Response()->json($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     // dd($request);
    //     $request->validate([
    //         'todo' => 'required',
    //     ]);

    //     $record = Todo::find($id);
    //     $record->todo = $request->todo;
    //     $record->save();
    //     return redirect()->route('todos.index')->with('success', 'Todo has been updated successfully');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //dd($id);
        $todo = Todo::find($request->id);
        $todo->is_active = 0;
        $todo->save();
        Log::info("ID: {$request->id} remove successfully");
        // return redirect()->route('todos.index')->with('success', 'Todo has been deleted successfully');
        return Response()->json($todo);
    }
}
