<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>PENGELUARAN PITIH DEN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-bg: #667eea;
            /* Ungu tua */
            --secondary-bg: #764ba2;
            /* Ungu lebih terang */
            --card-bg: rgba(255, 255, 255, 0.1);
            --border-color: rgba(255, 255, 255, 0.2);
            --text-color-light: rgba(255, 255, 255, 0.9);
            --text-color-muted: rgba(255, 255, 255, 0.7);
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, var(--primary-bg) 0%, var(--secondary-bg) 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-color-light);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem 0;
        }

        .main-container {
            width: 100%;
            max-width: 800px;
            padding: 1.5rem;
        }

        /* Gaya kartu kustom */
        .card-custom {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        .dashboard-header {
            display: grid;
            grid-template-columns: 1fr auto;
            grid-template-rows: auto auto auto auto;
            grid-template-areas:
                "title logout"
                "description logout"
                "saldo-info saldo-info"
                "user-info user-info";
            gap: 0.5rem 1rem;
            padding: 2rem;
            align-items: start;
        }

        .dashboard-header .header-title {
            grid-area: title;
            text-align: left;
            margin-bottom: 0;
            color: white;
            font-size: 2rem;
            font-weight: 700;
        }

        .dashboard-header .header-description {
            grid-area: description;
            text-align: left;
            margin-top: 0;
            color: var(--text-color-muted);
            font-size: 1rem;
        }

        .dashboard-header .logout-form-grid {
            grid-area: logout;
            justify-self: end;
            align-self: start;
        }

        .dashboard-header .saldo-info {
            grid-area: saldo-info;
            display: flex;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.1);
            padding: 1rem;
            border-radius: 10px;
            margin-top: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .saldo-item {
            text-align: center;
            flex: 1;
        }

        .saldo-item .label {
            color: var(--text-color-muted);
            font-size: 0.9rem;
            margin-bottom: 0.3rem;
        }

        .saldo-item .value {
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--success-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
            font-weight: bold;
            flex-shrink: 0;
        }

        .dashboard-header .user-info-details {
            grid-area: user-info;
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .dashboard-header .user-info-details .user-meta {
            text-align: left;
        }

        .logout-btn {
            background: var(--danger-color);
            border: none;
            padding: 0.7rem 1.2rem;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .logout-btn:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        /* Saldo Setup Section */
        .saldo-setup {
            background: rgba(255, 193, 7, 0.15);
            border: 1px solid rgba(255, 193, 7, 0.3);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .saldo-setup-icon {
            color: var(--warning-color);
            font-size: 2.5rem;
            margin-bottom: 0.8rem;
        }

        .saldo-setup-text {
            color: white;
            font-size: 1.1rem;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .saldo-setup-form {
            display: flex;
            gap: 1rem;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        .saldo-input {
            padding: 0.8rem 1.2rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            min-width: 200px;
            text-align: center;
        }

        .saldo-input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.15);
        }

        .saldo-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .saldo-btn {
            background: var(--warning-color);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            color: #212529;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .saldo-btn:hover {
            background: #e0a800;
            transform: translateY(-2px);
        }

        .progress-container {
            margin-top: 1rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .progress-bar-custom {
            height: 10px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }

        .progress-fill {
            height: 100%;
            background: var(--success-color);
            border-radius: 5px;
            transition: width 0.5s ease;
        }

        .progress-text {
            color: var(--text-color-muted);
            font-size: 0.95rem;
            font-weight: 500;
        }

        .alert {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            color: white;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            border-color: rgba(40, 167, 69, 0.4);
            background: rgba(40, 167, 69, 0.15);
        }

        .alert-danger {
            border-color: rgba(220, 53, 69, 0.4);
            background: rgba(220, 53, 69, 0.15);
        }

        .task-input-group {
            display: flex;
            gap: 1rem;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .input-row {
            display: flex;
            gap: 1rem;
            width: 100%;
            align-items: center;
            margin-bottom: 1rem;
        }

        .task-input {
            flex: 2;
            padding: 0.8rem 1.2rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .jumlah-input {
            flex: 1;
            padding: 0.8rem 1.2rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .task-input:focus,
        .jumlah-input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.15);
        }

        .task-input::placeholder,
        .jumlah-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .add-btn {
            background: var(--success-color);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
            height: fit-content;
        }

        .add-btn:hover {
            background: #218838;
            transform: translateY(-2px);
        }

        /* Daftar tugas */
        .task-item {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            padding: 1.2rem;
            margin-bottom: 0.8rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            transition: background-color 0.3s ease;
        }

        .task-item:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        .task-content {
            display: flex;
            flex-direction: column;
            flex: 1;
            gap: 0.3rem;
        }

        .task-name {
            font-size: 1.05rem;
            font-weight: 500;
            color: var(--text-color-light);
            line-height: 1.5;
        }

        .task-amount {
            font-size: 0.9rem;
            color: var(--text-color-muted);
            font-weight: 400;
        }

        .task-done .task-name {
            text-decoration: line-through;
            color: rgba(255, 255, 255, 0.6);
            opacity: 0.7;
            font-weight: 400;
        }

        .task-done .task-amount {
            text-decoration: line-through;
            opacity: 0.7;
        }

        .task-status {
            margin-right: 0.8rem;
            font-size: 1.15rem;
        }

        .task-status.done {
            color: #4CAF50;
        }

        .task-status.pending {
            color: rgba(255, 255, 255, 0.5);
        }

        .task-actions {
            display: flex;
            gap: 0.5rem;
            flex-shrink: 0;
        }

        .task-btn {
            padding: 0.4rem 0.8rem;
            border: none;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .btn-complete {
            background: var(--success-color);
            color: white;
        }

        .btn-complete:hover {
            background: #218838;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: var(--danger-color);
            color: white;
        }

        .btn-delete:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        .empty-state {
            text-align: center;
            padding: 2rem 1rem;
            color: var(--text-color-muted);
        }

        .empty-icon {
            font-size: 3rem;
            margin-bottom: 0.8rem;
            opacity: 0.6;
        }

        .empty-text {
            font-size: 1rem;
            margin-bottom: 0.4rem;
        }

        .empty-subtext {
            font-size: 0.85rem;
            opacity: 0.7;
        }

        @media (max-width: 768px) {
            .dashboard-header {
                grid-template-columns: 1fr;
                grid-template-rows: auto auto auto auto auto;
                grid-template-areas:
                    "title"
                    "description"
                    "saldo-info"
                    "user-info"
                    "logout";
                gap: 1rem 0;
                padding: 1.5rem;
            }

            .dashboard-header .logout-form-grid {
                justify-self: stretch;
                margin-top: 1rem;
            }

            .dashboard-header .logout-btn {
                width: 100%;
            }

            .dashboard-header .header-title,
            .dashboard-header .header-description,
            .dashboard-header .user-info-details {
                text-align: left;
                justify-content: flex-start;
                justify-self: start;
            }

            .dashboard-header .user-info-details {
                flex-direction: row;
            }

            .input-row {
                flex-direction: column;
                align-items: stretch;
            }

            .task-input,
            .jumlah-input {
                flex: none;
                width: 100%;
            }

            .add-btn {
                width: 100%;
            }

            .saldo-setup-form {
                flex-direction: column;
                align-items: stretch;
            }

            .saldo-input {
                min-width: auto;
                width: 100%;
            }

            .saldo-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container main-container">
        <!-- Bagian Header -->
        <div class="card-custom dashboard-header">
            <!-- Judul dan Deskripsi -->
            <h1 class="header-title"><i class="fas fa-wallet"></i> PITIH DEN</h1>
            <p class="header-description">Kelola Pengeluaran Ang Salamo Magang samo Kost di Bandung
            </p>

            <!-- Tombol Logout -->
            <form action="{{ route('logout') }}" method="POST" class="logout-form-grid">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>

            <!-- Info Saldo -->
            <div class="saldo-info">
                <div class="saldo-item">
                    <div class="label">Pitih Ang</div>
                    <div class="value">Rp {{ number_format($saldoAwal, 0, ',', '.') }}</div>
                </div>
                <div class="saldo-item">
                    <div class="label">Total Pengeluaran Ang</div>
                    <div class="value">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                </div>
                <div class="saldo-item">
                    <div class="label">Pitih Tasiso</div>
                    <div class="value">Rp {{ number_format($saldoTersisa, 0, ',', '.') }}</div>
                </div>
            </div>

            <!-- Info Pengguna -->
            <div class="user-info-details">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                </div>
                <div>
                    <div style="color: white; font-weight: 600;">
                        Oii, {{ auth()->user()->username }}! 👋
                    </div>
                    <div style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">
                        {{ date('l, d M Y') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Setup Saldo Awal (hanya tampil jika saldo awal = 0) -->
        @if ($saldoAwal == 0)
            <div class="card-custom">
                <div class="saldo-setup">
                    <div class="saldo-setup-icon">
                        <i class="fas fa-piggy-bank"></i>
                    </div>
                    <div class="saldo-setup-text">
                        Selamat datang! Silakan masukkan saldo awal Anda untuk memulai tracking pengeluaran.
                    </div>
                    <form action="{{ route('updateSaldoAwal') }}" method="POST">
                        class="saldo-setup-form">
                        @csrf
                        <input type="number" name="saldo" class="saldo-input" placeholder="Masukkan saldo awal (Rp)"
                            required min="0" step="1000" value="{{ old('saldo') }}">
                        <button type="submit" class="saldo-btn">
                            <i class="fas fa-save"></i> Simpan Pitih
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- Tombol Edit Saldo (hanya tampil jika sudah ada saldo) -->
            <div class="card-custom">
                <h2 style="color: white; font-size: 1.4rem; margin-bottom: 1.5rem;">
                    <i class="fas fa-edit me-2"></i>
                    Ubah Pitih Ang
                </h2>
                <form action="{{ route('updateSaldoAwal') }}" method="POST" class="saldo-setup-form"
                    style="justify-content: flex-start;">
                    @csrf
                    <input type="number" name="saldo" class="saldo-input" placeholder="Saldo awal baru (Rp)" required
                        min="{{ $totalPengeluaran }}" step="1000" value="{{ old('saldo', $saldoAwal) }}">
                    <button type="submit" class="saldo-btn">
                        <i class="fas fa-sync-alt"></i> Perbarui Pitih Ang
                    </button>
                </form>

                {{-- <div style="color: var(--text-color-muted); font-size: 0.9rem; margin-top: 0.5rem;">
                    <i class="fas fa-info-circle"></i> Minimal saldo awal: Rp
                    {{ number_format($totalPengeluaran, 0, ',', '.') }}
                </div> --}}
            </div>
        @endif

        {{-- <!-- Bilah Kemajuan -->
        @if ($tasks->count() > 0)
            <div class="progress-container card-custom">
                <div class="progress-bar-custom">
                    <div class="progress-fill"
                        style="width: {{ ($tasks->where('is_done', true)->count() / $tasks->count()) * 100 }}%"></div>
                </div>
                <div class="progress-text">
                    {{ round(($tasks->where('is_done', true)->count() / $tasks->count()) * 100) }}% pengeluaran telah
                    selesai
                </div>
            </div>
        @endif --}}

        <!-- Notifikasi -->
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Oops! Ada beberapa kesalahan:</strong>
                <ul class="mt-2 mb-0" style="padding-left: 1.2rem;">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Bagian Pengeluaran Baru (hanya tampil jika sudah ada saldo) -->
        @if ($saldoAwal > 0)
            <div class="card-custom">
                <h2 class="add-task-title" style="color: white; font-size: 1.4rem; margin-bottom: 1.5rem;">
                    <i class="fas fa-plus-circle me-2"></i>
                    Tambah Pengeluaran Baru Ang
                </h2>
                <form action="{{ route('tasks.store') }}" method="POST" id="addTaskForm">
                    @csrf
                    <div class="task-input-group">
                        <div class="input-row">
                            <input type="text" name="nama_pengeluaran" class="task-input"
                                placeholder="Namo pengeluaran ang" required id="taskInput"
                                value="{{ old('nama_pengeluaran') }}">
                            <input type="number" name="jumlah" class="jumlah-input" placeholder="Bara pitih ee (Rp)"
                                required min="0" step="500" value="{{ old('jumlah') }}"
                                max="{{ $saldoTersisa }}">
                            <button class="add-btn" type="submit" id="addTaskBtn">
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Bagian Daftar Pengeluaran -->
            <div class="card-custom">
                <h2 class="tasks-title" style="color: white; font-size: 1.4rem; margin-bottom: 1.5rem;">
                    <i class="fas fa-clipboard-list me-2"></i>
                    Daftar Pengeluaran Ang
                </h2>

                <div id="tasksList">
                    @forelse ($tasks as $task)
                        <div class="task-item {{ $task->is_done ? 'task-done' : '' }}"
                            data-task-id="{{ $task->id }}">
                            <div style="display: flex; align-items: center; flex: 1;">
                                <div class="task-status {{ $task->is_done ? 'done' : 'pending' }}">
                                    @if ($task->is_done)
                                        <i class="fas fa-check-circle"></i>
                                    @else
                                        <i class="far fa-circle"></i>
                                    @endif
                                </div>
                                <div class="task-content">
                                    <div class="task-name">{{ $task->nama_pengeluaran }}</div>
                                    <div class="task-amount">Rp {{ number_format($task->jumlah, 0, ',', '.') }}</div>
                                </div>
                            </div>
                            <div class="task-actions">
                                @if (!$task->is_done)
                                    <form method="POST" action="{{ route('tasks.done', $task->id) }}"
                                        class="d-inline task-form">
                                        @csrf
                                        {{-- <button class="task-btn btn-complete" type="submit">
                                            <i class="fas fa-check"></i> Selesai
                                        </button> --}}
                                    </form>
                                @endif
                                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}"
                                    class="d-inline task-form">
                                    @csrf
                                    @method('DELETE')
                                    <button class="task-btn btn-delete" type="submit"
                                        onclick="return confirm('Yakin hapus pengeluaran ini? Saldo akan dikembalikan.')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <div class="empty-text">Belum ada pengeluaran</div>
                            <div class="empty-subtext">Tambahkan pengeluaran pertama Anda untuk memulai!</div>
                        </div>
                    @endforelse
                </div>
            </div>
        @endif
    </div>

    <script>
        // Sembunyikan alert otomatis setelah 5 detik
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });

        // Fokus pada input tugas saat halaman dimuat (jika ada)
        document.addEventListener('DOMContentLoaded', function() {
            const taskInput = document.getElementById('taskInput');
            if (taskInput) {
                taskInput.focus();
            }
        });
    </script>
</body>

</html>
