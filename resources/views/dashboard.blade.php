@extends('layouts.app')

@section('title', 'Dashboard — ToDo List App')

@section('content')

    <!-- 1. Welcome & Productivity Summary -->
    <div class="card" style="margin-bottom: 1.75rem;">
        <div class="card-body welcome-banner-responsive" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
            <div>
                <h1 class="welcome-title-responsive" style="font-size: var(--font-size-2xl); font-weight: 700; margin-bottom: 0.25rem;">
                    Halo, {{ auth()->user()->username }}! 👋
                </h1>
                <p style="font-size: var(--font-size-sm); color: var(--text-secondary);">
                    Kelola to-do list harian Anda dan pantau alokasi biaya pengeluaran dengan rapi.
                </p>
            </div>
            <div style="font-size: var(--font-size-sm); color: var(--text-secondary); font-weight: 500; background: var(--bg-surface-secondary); padding: 0.5rem 1rem; border-radius: var(--radius-full); border: 1px solid var(--border-color);">
                📅 {{ date('l, d M Y') }}
            </div>
        </div>
    </div>

    <!-- 2. Metrics / Statistik Grid -->
    <div class="stats-grid">
        <!-- Card 1: Status ToDo List -->
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-label">Total Tugas</span>
                <span class="stat-icon primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                </span>
            </div>
            <div class="stat-value">
                {{ $totalTasks }} <span style="font-size: var(--font-size-sm); font-weight: 500; color: var(--text-secondary);">Tugas</span>
            </div>
            <div style="font-size: var(--font-size-xs); color: var(--text-muted); margin-top: 0.25rem;">
                <span style="color: var(--color-success); font-weight: 600;">{{ $completedTasks }} Selesai</span> • 
                <span style="color: var(--color-warning); font-weight: 600;">{{ $pendingTasks }} Pending</span>
            </div>
        </div>

        <!-- Card 2: Sisa Saldo Dompet -->
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-label">Sisa Saldo Dompet</span>
                <span class="stat-icon success">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                        <line x1="2" y1="10" x2="22" y2="10"></line>
                    </svg>
                </span>
            </div>
            <div class="stat-value" style="color: var(--color-success);">
                Rp {{ number_format($saldoTersisa, 0, ',', '.') }}
            </div>
            <div style="font-size: var(--font-size-xs); color: var(--text-muted); margin-top: 0.25rem;">
                Dana aktif yang siap dialokasikan
            </div>
        </div>

        <!-- Card 3: Total Alokasi Biaya Terpakai -->
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-label">Total Alokasi Biaya</span>
                <span class="stat-icon danger">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="23 18 13.5 8.5 8.5 13.5 1 6"></polyline>
                        <polyline points="17 18 23 18 23 12"></polyline>
                    </svg>
                </span>
            </div>
            <div class="stat-value" style="color: var(--color-danger);">
                Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
            </div>
            <div style="font-size: var(--font-size-xs); color: var(--text-muted); margin-top: 0.25rem;">
                Akumulasi seluruh biaya tugas
            </div>
        </div>
    </div>

    <!-- 3. Progress Bar Produktivitas -->
    @if ($totalTasks > 0)
        <div class="progress-card">
            <div class="progress-header">
                <div class="progress-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-primary);">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    Progres Penyelesaian Tugas
                </div>
                <div class="progress-badge">
                    {{ $completedTasks }} / {{ $totalTasks }} Selesai ({{ $progressPercent }}%)
                </div>
            </div>
            <div class="progress-track">
                <div class="progress-bar" style="width: {{ $progressPercent }}%;"></div>
            </div>
        </div>
    @endif

    <!-- 4. KELOLA SALDO DOMPET (DI ATAS FORM TUGAS) -->
    <div class="card" style="margin-bottom: 2rem;">
        <div class="card-header">
            <h2 style="font-size: var(--font-size-base); font-weight: 700; color: var(--text-main); display: flex; align-items: center; gap: 0.5rem;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-success);">
                    <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                    <line x1="2" y1="10" x2="22" y2="10"></line>
                </svg>
                Kelola Saldo Dompet
            </h2>
            <div style="font-size: var(--font-size-xs); font-weight: 600; color: var(--color-success); background: var(--color-success-light); padding: 0.3rem 0.75rem; border-radius: var(--radius-full); border: 1px solid #a7f3d0;">
                Sisa Saldo: Rp {{ number_format($saldoTersisa, 0, ',', '.') }}
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('updateSaldoAwal') }}" method="POST">
                @csrf
                <div style="display: flex; gap: 1.25rem; align-items: center; margin-bottom: 1rem; flex-wrap: wrap;">
                    <label style="display: flex; align-items: center; gap: 0.4rem; font-size: var(--font-size-sm); cursor: pointer; font-weight: 600;">
                        <input type="radio" name="action_type" value="add" checked onchange="updateSaldoFormText(this.value)">
                        ➕ Tambah Saldo (Top-Up)
                    </label>
                    <label style="display: flex; align-items: center; gap: 0.4rem; font-size: var(--font-size-sm); cursor: pointer; font-weight: 600; color: var(--text-secondary);">
                        <input type="radio" name="action_type" value="set" onchange="updateSaldoFormText(this.value)">
                        🔄 Setel Ulang Total Saldo
                    </label>
                </div>

                <div class="form-row">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label" for="inputSaldoDompet" id="labelNominalSaldo">Nominal Top-Up (Rp)</label>
                        <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" inputmode="numeric" name="saldo" id="inputSaldoDompet" class="form-control format-rupiah" placeholder="Contoh: 50.000" required>
                        </div>
                    </div>

                    <div style="margin-bottom: 0;">
                        <label class="form-label desktop-spacer-label" style="visibility: hidden;">Quick Action</label>
                        <div class="quick-chips-grid" style="display: flex; gap: 0.35rem; flex-wrap: wrap;">
                            <button type="button" class="quick-chip" onclick="setNominal(10000)">+10rb</button>
                            <button type="button" class="quick-chip" onclick="setNominal(20000)">+20rb</button>
                            <button type="button" class="quick-chip" onclick="setNominal(50000)">+50rb</button>
                            <button type="button" class="quick-chip" onclick="setNominal(100000)">+100rb</button>
                        </div>
                    </div>

                    <div style="margin-bottom: 0;">
                        <label class="form-label desktop-spacer-label" style="visibility: hidden;">Submit</label>
                        <button type="submit" class="btn btn-secondary" id="btnSubmitSaldo" style="height: 46px; width: 100%; white-space: nowrap;">
                            Tambah ke Dompet
                        </button>
                    </div>
                </div>

                <p id="saldoHelpText" style="font-size: var(--font-size-xs); color: var(--text-muted); margin-top: 0.75rem;">
                    * Nominal yang Anda masukkan akan langsung ditambahkan ke saldo dompet saat ini (Rp {{ number_format($saldoTersisa, 0, ',', '.') }}).
                </p>
            </form>
        </div>
    </div>

    <!-- 5. FORM TAMBAH TUGAS BARU (RAPI, SEJAJAR 100%, PRESISI) -->
    <div class="card" style="margin-bottom: 2rem;">
        <div class="card-header">
            <h2 style="font-size: var(--font-size-base); font-weight: 700; color: var(--text-main); display: flex; align-items: center; gap: 0.5rem;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-primary);">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="16"></line>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
                Tambah Tugas Baru ke ToDo List
            </h2>
        </div>
        <div class="card-body">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <!-- Kolom 1: Nama Tugas -->
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label" for="nama_pengeluaran">
                            Nama Tugas / Aktivitas <span style="color: var(--color-danger);">*</span>
                        </label>
                        <input type="text" name="nama_pengeluaran" id="nama_pengeluaran" class="form-control" placeholder="Contoh: Belajar Laravel, Beli bahan makanan, Bayar tagihan..." required value="{{ old('nama_pengeluaran') }}">
                    </div>

                    <!-- Kolom 2: Biaya Pengeluaran dengan Input Group Rp -->
                    <div class="form-group" style="margin-bottom: 0;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                            <label class="form-label" for="jumlah" style="margin-bottom: 0;">Biaya (Opsional)</label>
                            <span style="font-size: var(--font-size-xs); color: var(--text-muted); font-weight: 500;">
                                Sisa: <strong style="color: var(--color-success);">Rp {{ number_format($saldoTersisa, 0, ',', '.') }}</strong>
                            </span>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" inputmode="numeric" name="jumlah" id="jumlah" class="form-control format-rupiah" placeholder="0 jika gratis" value="{{ old('jumlah') ? number_format((float) str_replace('.', '', old('jumlah')), 0, ',', '.') : '' }}">
                        </div>
                    </div>

                    <!-- Kolom 3: Tombol Tambah Tugas (Rata Sejajar) -->
                    <div style="margin-bottom: 0;">
                        <label class="form-label desktop-spacer-label" style="visibility: hidden;">Submit</label>
                        <button type="submit" class="btn btn-primary" style="height: 46px; width: 100%; white-space: nowrap; display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Tambah Tugas
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- 6. DAFTAR TODOLIST INTERAKTIF -->
    <div class="card" style="margin-bottom: 2rem;">
        <div class="card-header todo-header-wrapper" style="flex-wrap: wrap; gap: 1rem;">
            <h2 style="font-size: var(--font-size-base); font-weight: 700; display: flex; align-items: center; gap: 0.5rem;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-primary);">
                    <line x1="8" y1="6" x2="21" y2="6"></line>
                    <line x1="8" y1="12" x2="21" y2="12"></line>
                    <line x1="8" y1="18" x2="21" y2="18"></line>
                    <line x1="3" y1="6" x2="3.01" y2="6"></line>
                    <line x1="3" y1="12" x2="3.01" y2="12"></line>
                    <line x1="3" y1="18" x2="3.01" y2="18"></line>
                </svg>
                Daftar ToDo List (<span id="taskCountDisplay">{{ $tasks->count() }}</span>)
            </h2>

            <!-- Filter Tabs -->
            <div class="filter-tabs">
                <button type="button" class="filter-btn active" data-filter="all">Semua ({{ $totalTasks }})</button>
                <button type="button" class="filter-btn" data-filter="pending">Pending ({{ $pendingTasks }})</button>
                <button type="button" class="filter-btn" data-filter="done">Selesai ({{ $completedTasks }})</button>
            </div>
        </div>

        <div class="card-body">
            @if($tasks->isEmpty())
                <div class="empty-box">
                    <svg class="empty-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    <h3 class="empty-title">Belum Ada Tugas</h3>
                    <p class="empty-desc">Tambahkan tugas pertama Anda melalui form di atas untuk memulai!</p>
                </div>
            @else
                <div class="task-list" id="taskListContainer">
                    @foreach ($tasks as $task)
                        <div class="task-item {{ $task->is_done ? 'is-completed' : '' }}" data-status="{{ $task->is_done ? 'done' : 'pending' }}">
                            <div class="task-left">
                                <!-- Interactive Toggle Done Form -->
                                <form action="{{ route('tasks.done', $task->id) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="btn-check-task {{ $task->is_done ? 'checked' : '' }}" title="{{ $task->is_done ? 'Klik untuk batal selesai' : 'Klik untuk tandai selesai' }}">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    </button>
                                </form>

                                <div class="task-details">
                                    <span class="task-title">{{ $task->nama_pengeluaran }}</span>
                                    <span class="task-date">{{ $task->created_at ? $task->created_at->format('d M Y, H:i') : 'Baru saja' }}</span>
                                </div>
                            </div>

                            <div class="task-right">
                                @if($task->jumlah > 0)
                                    <span class="task-price-tag">
                                        - Rp {{ number_format($task->jumlah, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span style="font-size: var(--font-size-xs); font-weight: 600; color: var(--text-muted); background: var(--bg-surface-secondary); padding: 0.25rem 0.5rem; border-radius: var(--radius-sm); border: 1px solid var(--border-color);">
                                        Tanpa Biaya
                                    </span>
                                @endif

                                <!-- Delete Task Form -->
                                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger-outline btn-sm" title="Hapus tugas" onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

@endsection

@push('scripts')
<script>
    // Fungsi Pemformatan Angka Rupiah Real-Time dengan Titik Ribuan
    function formatRupiahNumber(val) {
        if (!val) return '';
        const clean = val.toString().replace(/\D/g, '');
        if (!clean) return '';
        return clean.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    // Pasang Event Listener Live Formatting ke semua input berkelas .format-rupiah
    document.querySelectorAll('.format-rupiah').forEach(input => {
        // Format nilai awal jika ada
        if (input.value) {
            input.value = formatRupiahNumber(input.value);
        }

        input.addEventListener('input', function() {
            const cursorPosition = this.selectionStart;
            const oldLength = this.value.length;
            this.value = formatRupiahNumber(this.value);
            const newLength = this.value.length;

            // Pertahankan posisi kursor agar pengalaman mengetik tetap mulus
            const diff = newLength - oldLength;
            this.setSelectionRange(cursorPosition + diff, cursorPosition + diff);
        });
    });

    // Quick chips untuk input nominal top-up saldo
    function setNominal(amount) {
        const input = document.getElementById('inputSaldoDompet');
        if (input) {
            input.value = formatRupiahNumber(amount);
            input.focus();
        }
    }

    // Bersihkan titik pemisah ribuan sebelum form dikirim ke server
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            this.querySelectorAll('.format-rupiah').forEach(input => {
                input.value = input.value.replace(/\./g, '');
            });
        });
    });

    // Client-side Instant Filter (Semua, Pending, Selesai)
    const filterButtons = document.querySelectorAll('.filter-btn');
    const taskItems = document.querySelectorAll('.task-item');
    const countDisplay = document.getElementById('taskCountDisplay');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            filterButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filter = btn.dataset.filter;
            let visibleCount = 0;

            taskItems.forEach(item => {
                const status = item.dataset.status;
                if (filter === 'all' || status === filter) {
                    item.style.display = 'flex';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            if (countDisplay) {
                countDisplay.textContent = visibleCount;
            }
        });
    });

    // Helper text untuk form saldo
    function updateSaldoFormText(mode) {
        const btn = document.getElementById('btnSubmitSaldo');
        const help = document.getElementById('saldoHelpText');
        const label = document.getElementById('labelNominalSaldo');
        const currentSaldo = "{{ number_format($saldoTersisa, 0, ',', '.') }}";

        if (mode === 'add') {
            btn.textContent = 'Tambah ke Dompet';
            label.textContent = 'Nominal Top-Up (Rp)';
            help.textContent = '* Nominal yang Anda masukkan akan langsung ditambahkan ke saldo dompet saat ini (Rp ' + currentSaldo + ').';
        } else {
            btn.textContent = 'Setel Total Saldo';
            label.textContent = 'Total Saldo Baru (Rp)';
            help.textContent = '* Saldo dompet saat ini akan diubah secara langsung menjadi nominal yang Anda tentukan.';
        }
    }
</script>
@endpush
