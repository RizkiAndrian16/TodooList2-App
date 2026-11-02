@extends('layouts.app')

@section('title', 'Masuk — ToDo List App')

@section('content')
<div class="auth-box-wrapper" style="max-width: 440px; margin: 2rem auto;">
    <div class="card" style="box-shadow: var(--shadow-md);">
        <div class="card-body auth-card-body" style="padding: 2.25rem;">
            <div style="text-align: center; margin-bottom: 2rem;">
                <div class="brand-badge" style="width: 3.25rem; height: 3.25rem; margin: 0 auto 1rem; border-radius: var(--radius-lg);">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                </div>
                <h1 style="font-size: var(--font-size-2xl); font-weight: 700; margin-bottom: 0.35rem;">ToDo List App</h1>
                <p style="font-size: var(--font-size-sm); color: var(--text-secondary);">Masuk untuk mengelola daftar tugas Anda</p>
            </div>

            <form method="POST" action="{{ url('/login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required autofocus value="{{ old('username') }}">
                </div>

                <div class="form-group" style="margin-bottom: 1.75rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <label class="form-label" for="password" style="margin-bottom: 0;">Password</label>
                    </div>
                    <div style="position: relative;">
                        <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                        <button type="button" id="togglePassword" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--text-muted); padding: 4px;" aria-label="Lihat password">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; height: 46px; font-size: var(--font-size-base);">
                    Masuk Sekarang
                </button>

                <div style="text-align: center; margin-top: 1.5rem; font-size: var(--font-size-sm); color: var(--text-secondary);">
                    Belum punya akun? <a href="{{ route('register') }}" style="font-weight: 600;">Daftar di sini</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const toggleBtn = document.getElementById('togglePassword');
    const pwdInput = document.getElementById('password');
    if (toggleBtn && pwdInput) {
        toggleBtn.addEventListener('click', () => {
            const isPassword = pwdInput.type === 'password';
            pwdInput.type = isPassword ? 'text' : 'password';
        });
    }
</script>
@endpush
