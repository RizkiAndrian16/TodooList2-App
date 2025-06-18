<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - ToDo List App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --gradient: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            --glass-bg: rgba(255, 255, 255, 0.15);
            --glass-border: rgba(255, 255, 255, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--gradient);
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
            position: relative;
        }

        /* Glassmorphism login box */
        .login-container {
            position: relative;
            z-index: 1;
        }

        .login-box {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            padding: 3rem 2.5rem;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 420px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-title {
            color: white;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .login-subtitle {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1rem;
            font-weight: 300;
        }

        /* Form styling */
        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.6);
            transition: color 0.3s ease;
        }

        .form-group:focus-within .input-icon {
            color: rgba(255, 255, 255, 0.9);
        }

        /* Password toggle */
        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: rgba(255, 255, 255, 0.9);
        }

        /* Login button */
        .login-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #6a82fb 0%, #fc5c7d 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        /* Loading state */
        .login-btn.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .login-btn.loading .btn-text {
            opacity: 0;
        }

        .login-btn.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Register link */
        .register-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .register-link a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: white;
            text-decoration: underline;
        }

        /* Alert styling */
        .alert {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: white;
            padding: 1rem;
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
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <h1 class="login-title">Welcome Back</h1>
                <p class="login-subtitle">Login ke akun Anda</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if ($errors->has('login'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first('login') }}
                </div>
            @endif

            <form method="POST" action="{{ url('/login') }}" id="loginForm">
                @csrf

                <div class="form-group">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" name="username" id="username" class="form-input" placeholder="Username"
                        required autofocus>
                </div>

                <div class="form-group">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" id="password" class="form-input" placeholder="Password"
                        required>
                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                </div>

                <button type="submit" class="login-btn" id="loginBtn">
                    <span class="btn-text">Masuk</span>
                </button>

                <div class="register-link">
                    <a href="{{ route('register') }}">
                        Belum punya akun? <span style="text-decoration: underline;">Daftar di sini</span>
                    </a>
                </div>

            </form>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this;

            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('loginBtn');
            submitBtn.classList.add('loading');
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                const activeElement = document.activeElement;
                if (activeElement.tagName === 'INPUT' && activeElement.form.id === 'loginForm') {
                    document.getElementById('loginForm').submit();
                }
            }
        });
    </script>
</body>

</html>
