<!-- ==========================================================================
     MODULAR NAVBAR COMPONENT (ToDo List App)
     ========================================================================== -->
<header class="app-navbar">
    <div class="app-container nav-wrapper">
        <!-- Brand / Logo -->
        <a href="{{ route('dashboard') }}" class="brand-link">
            <span class="brand-badge">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 11 12 14 22 4"></polyline>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                </svg>
            </span>
            <span>ToDo List</span>
        </a>

        <!-- Right Side: User Profile / Actions -->
        <div class="nav-actions">
            @auth
                <!-- User Chip -->
                <div class="user-chip">
                    <span class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->username ?? 'U', 0, 1)) }}
                    </span>
                    <span class="user-name-text">{{ Auth::user()->username }}</span>
                </div>

                <!-- Secure Logout Form -->
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-danger-outline btn-sm" title="Keluar dari akun">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        <span class="logout-btn-text">Logout</span>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-secondary btn-sm">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Daftar</a>
            @endauth
        </div>
    </div>
</header>
