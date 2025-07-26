@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="text-center mb-3">
            <div class="bounce-in">
                <i class="fas fa-graduation-cap" style="font-size: 4rem; color: white; margin-bottom: 1rem;"></i>
                <h2 class="text-white fw-bold mb-2">Selamat Datang!</h2>
                <p class="text-white-50">Mari mulai perjalanan penemuan minat dan bakat Anda</p>
            </div>
        </div>

        <div class="card slide-in-left">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary mb-2">
                        Login
                    </h3>
                    <p class="text-muted">Masuk ke akun Anda untuk melanjutkan</p>
                </div>

                <div id="alert-container"></div>

                <form id="loginForm">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-2"></i>Email
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-envelope text-muted"></i>
                            </span>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                   class="form-control border-start-0"
                                   placeholder="Masukkan email Anda" required>
                        </div>
                        <div class="invalid-feedback" id="email-error"></div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-2"></i>Password
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-lock text-muted"></i>
                            </span>
                            <input type="password" name="password" id="password"
                                   class="form-control border-start-0"
                                   placeholder="Masukkan password Anda" required>
                            <button type="button" class="btn btn-outline-secondary border-start-0" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback" id="password-error"></div>
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary w-100 py-3" id="loginBtn">
                            <span class="spinner-border spinner-border-sm d-none" id="loginSpinner" role="status"></span>
                            <i class="fas fa-rocket me-2"></i>
                            <span id="loginText">Login</span>
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="text-muted mb-0">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">
                                Daftar Sekarang
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = this;
        const loginBtn = document.getElementById('loginBtn');
        const spinner = document.getElementById('loginSpinner');
        const loginText = document.getElementById('loginText');
        const alertContainer = document.getElementById('alert-container');
        
        // Reset previous errors
        clearErrors();
        clearAlerts();
        
        // Show loading state
        loginBtn.disabled = true;
        spinner.classList.remove('d-none');
        loginText.textContent = 'Memproses...';
        
        const formData = new FormData(form);
        const data = {
            email: formData.get('email'),
            password: formData.get('password')
        };
        
        fetch('/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.token) {
                localStorage.setItem('jwt_token', data.token);

                if (data.user) { 
                    localStorage.setItem('user', JSON.stringify(data.user));
                } 

                showAlert('Login berhasil!', 'success');
                loginText.textContent = 'Berhasil!';
                loginBtn.classList.add('btn-success');
                createConfetti();
                
                setTimeout(() => {
                    window.location.href = '/dashboard';
                }, 2000);
            } else {
                showAlert((data.message || 'Login gagal'), 'danger');
                loginText.textContent = 'Login';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Terjadi kesalahan pada server', 'danger');
            loginText.textContent = 'Mulai Petualangan';
        })
        .finally(() => {
            // Reset loading state
            loginBtn.disabled = false;
            spinner.classList.add('d-none');
        });
    });

    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
    
    function clearErrors() {
        document.querySelectorAll('.is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
        });
        document.querySelectorAll('.invalid-feedback').forEach(el => {
            el.textContent = '';
        });
    }
    
    function clearAlerts() {
        const alertContainer = document.getElementById('alert-container');
        if (alertContainer) {
            alertContainer.innerHTML = '';
        }
    }
    
    function showAlert(message, type) {
        const alertContainer = document.getElementById('alert-container');
        if (!alertContainer) return;
        
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show bounce-in`;
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        alertContainer.appendChild(alertDiv);
    }

    function createConfetti() {
        const colors = ['#667eea', '#764ba2', '#4facfe', '#43e97b', '#fa709a'];
        for (let i = 0; i < 50; i++) {
            const confetti = document.createElement('div');
            confetti.style.position = 'fixed';
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.top = '-10px';
            confetti.style.width = '10px';
            confetti.style.height = '10px';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.borderRadius = '50%';
            confetti.style.pointerEvents = 'none';
            confetti.style.zIndex = '9999';
            confetti.style.animation = `fall ${Math.random() * 3 + 2}s linear forwards`;
            document.body.appendChild(confetti);
            
            setTimeout(() => {
                confetti.remove();
            }, 5000);
        }
    }

    const style = document.createElement('style');
    style.textContent = `
        @keyframes fall {
            to {
                transform: translateY(100vh) rotate(360deg);
            }
        }
    `;
    document.head.appendChild(style);
</script>
@endsection

