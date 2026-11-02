<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Menampilkan dashboard utama ToDo List
     */
    public function index()
    {
        $user = Auth::user();
        $tasks = Task::where('user_id', $user->id)->latest()->get();

        // Metrik Statistik ToDo List
        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('is_done', true)->count();
        $pendingTasks = $totalTasks - $completedTasks;
        $progressPercent = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        // Metrik Keuangan / Anggaran
        $totalPengeluaran = (float) $tasks->sum('jumlah');
        $saldoTersisa = (float) $user->saldo;
        $saldoAwal = $saldoTersisa + $totalPengeluaran;

        return view('dashboard', compact(
            'tasks',
            'user',
            'totalPengeluaran',
            'saldoAwal',
            'saldoTersisa',
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'progressPercent'
        ));
    }

    /**
     * Menyimpan tugas baru ke to-do list
     */
    public function store(Request $request)
    {
        // Bersihkan format titik rupiah jika ada sebelum divalidasi
        if ($request->filled('jumlah') && is_string($request->jumlah)) {
            $request->merge([
                'jumlah' => str_replace('.', '', $request->jumlah),
            ]);
        }

        $request->validate([
            'nama_pengeluaran' => 'required|string|max:255',
            'jumlah' => 'nullable|numeric|min:0',
        ], [
            'nama_pengeluaran.required' => 'Nama tugas / kegiatan wajib diisi.',
            'jumlah.numeric' => 'Biaya pengeluaran harus berupa angka.',
            'jumlah.min' => 'Biaya pengeluaran tidak boleh negatif.',
        ]);

        $user = Auth::user();
        $jumlah = $request->filled('jumlah') ? (float) $request->jumlah : 0;

        // Cek kecukupan saldo jika tugas memiliki alokasi biaya
        if ($jumlah > 0 && $user->saldo < $jumlah) {
            $kurang = $jumlah - $user->saldo;
            return redirect()->back()
                ->withInput()
                ->with('error', 'Saldo dompet tidak mencukupi untuk biaya tugas ini! Dibutuhkan Rp ' . number_format($jumlah, 0, ',', '.') . ' (Kurang Rp ' . number_format($kurang, 0, ',', '.') . '). Silakan isi saldo terlebih dahulu atau kosongkan biaya jika tugas ini gratis.');
        }

        Task::create([
            'user_id' => $user->id,
            'nama_pengeluaran' => $request->nama_pengeluaran,
            'jumlah' => $jumlah,
            'is_done' => false,
        ]);

        if ($jumlah > 0) {
            DB::table('users')
                ->where('id', $user->id)
                ->decrement('saldo', $jumlah);
            $msg = 'Tugas berhasil dicatat dengan alokasi biaya Rp ' . number_format($jumlah, 0, ',', '.') . '.';
        } else {
            $msg = 'Tugas baru berhasil ditambahkan ke to-do list!';
        }

        return redirect()->back()->with('success', $msg);
    }

    /**
     * Toggle status tugas (Selesai / Belum Selesai)
     */
    public function markDone($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $newStatus = !$task->is_done;
        $task->update(['is_done' => $newStatus]);

        $message = $newStatus 
            ? 'Hebat! Tugas berhasil diselesaikan. 🎉' 
            : 'Tugas dikembalikan ke daftar belum selesai.';

        return redirect()->back()->with('success', $message);
    }

    /**
     * Menghapus tugas dan mengembalikan alokasi saldo
     */
    public function destroy($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($task->jumlah > 0) {
            DB::table('users')
                ->where('id', Auth::id())
                ->increment('saldo', $task->jumlah);
            $msg = 'Tugas berhasil dihapus dan dana Rp ' . number_format($task->jumlah, 0, ',', '.') . ' telah dikembalikan ke saldo dompet.';
        } else {
            $msg = 'Tugas berhasil dihapus dari daftar.';
        }

        $task->delete();

        return redirect()->back()->with('success', $msg);
    }

    /**
     * Memperbarui atau menambah saldo pengguna
     */
    public function updateSaldoAwal(Request $request)
    {
        // Bersihkan format titik rupiah jika ada sebelum divalidasi
        if ($request->filled('saldo') && is_string($request->saldo)) {
            $request->merge([
                'saldo' => str_replace('.', '', $request->saldo),
            ]);
        }

        $request->validate([
            'saldo' => 'required|numeric|min:0',
            'action_type' => 'nullable|string|in:set,add',
        ], [
            'saldo.required' => 'Nominal saldo wajib diisi.',
            'saldo.numeric' => 'Saldo harus berupa angka valid.',
            'saldo.min' => 'Nominal saldo tidak boleh bernilai negatif.',
        ]);

        $actionType = $request->input('action_type', 'set');
        $amount = (float) $request->saldo;

        if ($actionType === 'add') {
            DB::table('users')
                ->where('id', Auth::id())
                ->increment('saldo', $amount);
            $message = 'Berhasil menambah dana sebesar Rp ' . number_format($amount, 0, ',', '.') . ' ke saldo dompet.';
        } else {
            DB::table('users')
                ->where('id', Auth::id())
                ->update(['saldo' => $amount]);
            $message = 'Total saldo dompet berhasil disetel menjadi Rp ' . number_format($amount, 0, ',', '.');
        }

        return redirect()->back()->with('success', $message);
    }
}
