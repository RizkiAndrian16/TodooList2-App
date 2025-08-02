<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tasks = Task::where('user_id', $user->id)->latest()->get();
        $totalPengeluaran = $tasks->sum('jumlah');
        $saldoAwal = $user->saldo;
        $saldoTersisa = $saldoAwal;

        return view('dashboard', compact(
            'tasks',
            'user',
            'totalPengeluaran',
            'saldoAwal',
            'saldoTersisa'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengeluaran' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
        ], [
            'nama_pengeluaran.required' => 'Nama pengeluaran harus diisi',
            'jumlah.required' => 'Jumlah pengeluaran harus diisi',
            'jumlah.numeric' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah tidak boleh kurang dari 0',
        ]);

        $user = Auth::user();

        if ($user->saldo < $request->jumlah) {
            return redirect()->back()->with('error', 'Saldo tidak mencukupi untuk pengeluaran ini.');
        }

        Task::create([
            'user_id' => $user->id,
            'nama_pengeluaran' => $request->nama_pengeluaran,
            'jumlah' => $request->jumlah,
            'is_done' => false,
        ]);

        DB::table('users')
            ->where('id', $user->id)
            ->decrement('saldo', $request->jumlah);

        return redirect()->back()->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    public function markDone($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $task->update(['is_done' => true]);

        return redirect()->back()->with('success', 'Pengeluaran ditandai selesai.');
    }

    public function destroy($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        DB::table('users')
            ->where('id', Auth::id())
            ->increment('saldo', $task->jumlah);

        $task->delete();

        return redirect()->back()->with('success', 'Pengeluaran berhasil dihapus dan saldo dikembalikan.');
    }

    public function updateSaldoAwal(Request $request)
    {
        $request->validate([
            'saldo' => 'required|numeric|min:0',
        ]);

        DB::table('users')
            ->where('id', Auth::id())
            ->update(['saldo' => $request->saldo]);

        return redirect()->back()->with('success', 'Pitih ang berhasil den simpan.');
    }
}
