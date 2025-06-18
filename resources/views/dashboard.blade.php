<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Simple To-Do List</title>
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
            grid-template-rows: auto auto auto;
            grid-template-areas:
                "title logout"
                "description logout"
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
            align-items: center;
            flex-wrap: wrap;
        }

        .task-input {
            flex: 1;
            padding: 0.8rem 1.2rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .task-input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.15);
        }

        .task-input::placeholder {
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
            align-items: center;
            flex: 1;
            gap: 0.8rem;
            word-break: break-word;
        }

        .task-text {
            font-size: 1.05rem;
            font-weight: 500;
            color: var(--text-color-light);
            line-height: 1.5;
        }

        .task-done .task-text {
            text-decoration: line-through;
            color: rgba(255, 255, 255, 0.6);
            opacity: 0.7;
            font-weight: 400;
        }

        .task-content .fas.fa-check-circle {
            color: #4CAF50;
            font-size: 1.15rem;
        }

        .task-content .far.fa-circle {
            color: rgba(255, 255, 255, 0.5);
            font-size: 1.15rem;
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
                /* Pada mobile, tata letak menjadi tumpukan vertikal */
                grid-template-columns: 1fr;
                grid-template-rows: auto auto auto auto;
                grid-template-areas:
                    "title"
                    "description"
                    "user-info"
                    "logout";
                /* Tombol logout pindah ke bawah */
                gap: 1rem 0;
                /* Sesuaikan jarak antar item */
                padding: 1.5rem;
                /* Sesuaikan padding */
            }

            .dashboard-header .logout-form-grid {
                justify-self: stretch;
                /* Tombol logout membentang penuh lebar */
                margin-top: 1rem;
                /* Tambah jarak dari info pengguna */
            }

            .dashboard-header .logout-btn {
                width: 100%;
                /* Pastikan tombol logout memenuhi lebar */
            }

            .dashboard-header .header-title,
            .dashboard-header .header-description,
            .dashboard-header .user-info-details {
                text-align: left;
                /* Pastikan semua item rata kiri pada mobile */
                justify-content: flex-start;
                /* Untuk konten flex di dalamnya */
                justify-self: start;
                /* Untuk item grid */
            }

            .dashboard-header .user-info-details {
                flex-direction: row;
                /* Pertahankan info pengguna dalam satu baris */
            }
        }
    </style>
</head>

<body>
    <div class="container main-container">
        <!-- Bagian Header -->
        <div class="card-custom dashboard-header">
            <!-- Judul dan Deskripsi -->
            <h1 class="header-title"><i class="fas fa-tasks"></i> TodoList-App</h1>
            <p class="header-description">Kelola tugas Anda dengan mudah dan efisien</p>

            <!-- Tombol Logout (untuk desktop, diposisikan oleh Grid) -->
            <form action="{{ route('logout') }}" method="POST" class="logout-form-grid">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>

            <!-- Info Pengguna dan Tanggal (berada di bawah judul dan deskripsi) -->
            <div class="user-info-details">
                <div class="user-avatar">
                    {{-- Ini contoh untuk Laravel Blade, Anda mungkin perlu menyesuaikannya --}}
                    {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                </div>
                <div>
                    <div style="color: white; font-weight: 600;">
                        {{-- Ini contoh untuk Laravel Blade, Anda mungkin perlu menyesuaikannya --}}
                        Halo, {{ auth()->user()->username }}! 👋
                    </div>
                    <div style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">
                        {{-- Ini contoh untuk Laravel Blade, Anda mungkin perlu menyesuaikannya --}}
                        {{ date('l, d M Y') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Bilah Kemajuan -->
        {{-- Ini contoh untuk Laravel Blade, Anda mungkin perlu menyesuaikannya --}}
        @if ($tasks->count() > 0)
            <div class="progress-container card-custom">
                <div class="progress-bar-custom">
                    <div class="progress-fill"
                        style="width: {{ ($tasks->where('is_done', true)->count() / $tasks->count()) * 100 }}%"></div>
                </div>
                <div class="progress-text">
                    {{ round(($tasks->where('is_done', true)->count() / $tasks->count()) * 100) }}% tugas telah selesai
                </div>
            </div>
        @endif

        <!-- Notifikasi -->
        {{-- Ini contoh untuk Laravel Blade, Anda mungkin perlu menyesuaikannya --}}
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        {{-- Ini contoh untuk Laravel Blade, Anda mungkin perlu menyesuaikannya --}}
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

        <!-- Bagian Tambah Tugas -->
        <div class="card-custom">
            <h2 class="add-task-title" style="color: white; font-size: 1.4rem; margin-bottom: 1.5rem;">
                <i class="fas fa-plus-circle me-2"></i>
                Tambah Tugas Baru
            </h2>
            {{-- Ini contoh untuk Laravel Blade, Anda mungkin perlu menyesuaikannya --}}
            <form action="{{ route('tasks.store') }}" method="POST" id="addTaskForm">
                @csrf
                <div class="task-input-group">
                    <input type="text" name="task" class="task-input"
                        placeholder="Apa yang ingin Anda kerjakan hari ini?" required id="taskInput">
                    <button class="add-btn" type="submit" id="addTaskBtn">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
            </form>
        </div>

        <!-- Bagian Daftar Tugas -->
        <div class="card-custom">
            <h2 class="tasks-title" style="color: white; font-size: 1.4rem; margin-bottom: 1.5rem;">
                <i class="fas fa-clipboard-list me-2"></i>
                Daftar Tugas Anda
            </h2>

            <div id="tasksList">
                {{-- Ini contoh untuk Laravel Blade, Anda mungkin perlu menyesuaikannya --}}
                @forelse ($tasks as $task)
                    <div class="task-item {{ $task->is_done ? 'task-done' : '' }}" data-task-id="{{ $task->id }}">
                        <div class="task-content">
                            <div class="task-text">
                                @if ($task->is_done)
                                    <i class="fas fa-check-circle me-2" style="color: var(--success-color);"></i>
                                @else
                                    <i class="far fa-circle me-2" style="color: var(--text-color-muted);"></i>
                                @endif
                                {{ $task->task }}
                            </div>
                        </div>
                        <div class="task-actions">
                            @if (!$task->is_done)
                                <form method="POST" action="{{ route('tasks.done', $task->id) }}"
                                    class="d-inline task-form">
                                    @csrf
                                    <button class="task-btn btn-complete" type="submit">
                                        <i class="fas fa-check"></i> Selesai
                                    </button>
                                </form>
                            @endif
                            <form method="POST" action="{{ route('tasks.destroy', $task->id) }}"
                                class="d-inline task-form">
                                @csrf
                                @method('DELETE')
                                <button class="task-btn btn-delete" type="submit"
                                    onclick="return confirm('Yakin hapus tugas ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-clipboard"></i>
                        </div>
                        <div class="empty-text">Belum ada tugas</div>
                        <div class="empty-subtext">Tambahkan tugas pertama Anda untuk memulai!</div>
                    </div>
                @endforelse
            </div>
        </div>
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

        // Fokus pada input tugas saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('taskInput').focus();
        });
    </script>
</body>

</html>
