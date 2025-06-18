<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->latest()->get();
        return view('dashboard', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'task' => $request->task,
            'is_done' => false,
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function markDone($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $task->update(['is_done' => true]);

        return redirect()->back()->with('success', 'Tugas ditandai selesai.');
    }

    public function destroy($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $task->delete();

        return redirect()->back()->with('success', 'Tugas berhasil dihapus.');
    }
}
