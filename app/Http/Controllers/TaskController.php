<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $query = Task::with(['status', 'creator', 'assignee']);

    // Filters
    if ($request->status_id) {
        $query->where('status_id', $request->status_id);
    }

    if ($request->user_id) {
        $query->where('assigned_to', $request->user_id);
    }

    if ($request->date) {
        $query->whereDate('created_at', $request->date);
    }

    // Sorting
    if ($request->sort == 'priority') {
        $query->orderBy('priority', 'asc'); // or 'desc' if needed
    } elseif ($request->sort == 'date_asc') {
        $query->orderBy('created_at', 'asc');
    } elseif ($request->sort == 'date_desc') {
        $query->orderBy('created_at', 'desc');
    } else {
        // Default sorting
        $query->latest(); // created_at desc
    }

    $tasks = $query->get(); // You can use paginate() if needed
    $statuses = Status::all();
    $users = User::all();

    return view('Task.index', compact('tasks', 'statuses', 'users'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Status::all();
       $users = User::all();
    return view('Task.create', compact('statuses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
        'status_id' => 'required|exists:statuses,id',
        'assigned_to' => 'nullable|exists:users,id',
    ]);

    $task = new Task();
    $task->title = $request->title;
    $task->description = $request->description;
    $task->status_id = $request->status_id;
    $task->created_by = auth()->id();


    if (auth()->user()->role === 'admin') {
        $task->assigned_to = $request->assigned_to;
    } else {
        $task->assigned_to = null;
    }

    if ($request->hasFile('image')) {
    $task->image = $request->file('image')->store('assests/images', 'public');
     }

     if ($request->status_id == Status::where('name', 'Done')->first()->id) {
        $task->completed_date = now();
    }
     $task->save();
      return redirect()->route('tasks.index')->with('success', 'Task created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
    $users = User::all();
    $statuses = Status::all();
    return view('Task.edit', compact('task', 'users', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $validated = $request->validate([
        
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
        'status_id' => 'required|exists:statuses,id',
        'priority' => 'required|in:low,medium,high',
        'assigned_to' => 'nullable|exists:users,id'
    ]);
     $task = Task::findOrFail($id);
     if ($request->hasFile('image')) {
        $path = $request->file('image')->store('tasks', 'public');
        $validated['image'] = $path;
    }
     $task->update($validated);


    return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
     // return response()->json(['message' => 'Task status updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $task = Task::findOrFail($id);

    // Delete the image if it exists
    if ($task->image && Storage::disk('public')->exists($task->image)) {
        Storage::disk('public')->delete($task->image);
    }

    $task->delete();

    return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
}
}
