@extends('layouts.app')

@section('content')
<!-- <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="text-center mb-3">
            <div class="bounce-in">
                <i class="fas fa-user-plus" style="font-size: 4rem; color: white; margin-bottom: 1rem;"></i>
                <h2 class="text-white fw-bold mb-2">Bergabunglah!</h2>
                <p class="text-white-50">Mulai perjalanan penemuan diri Anda hari ini</p>
            </div>
        </div>

        <div class="card slide-in-left">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary mb-2">
                        Daftar
                    </h3>
                    <p class="text-muted">Buat akun baru untuk memulai petualangan</p>
                </div>

                <div id="alert-container"></div>

                <form id="registerForm">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label">
                            <i class="fas fa-user me-2"></i>Nama Lengkap
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-user text-muted"></i>
                            </span>
                            <input type="text" name="name" id="name" class="form-control border-start-0"
                                   value="{{ old('name') }}" placeholder="Masukkan nama lengkap Anda" required>
                        </div>
                        <div class="invalid-feedback" id="name-error"></div>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-2"></i>Email
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-envelope text-muted"></i>
                            </span>
                            <input type="email" name="email" id="email" class="form-control border-start-0"
                                   value="{{ old('email') }}" placeholder="Masukkan email aktif Anda" required>
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
                            <input type="password" name="password" id="password" class="form-control border-start-0"
                                   placeholder="Minimal 8 karakter" required>
                            <button type="button" class="btn btn-outline-secondary border-start-0" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback" id="password-error"></div>
                        <div class="password-strength mt-2" id="passwordStrength"></div>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">
                            <i class="fas fa-check-circle me-2"></i>Konfirmasi Password
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-check-circle text-muted"></i>
                            </span>
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="form-control border-start-0" placeholder="Ulangi password Anda" required>
                            <button type="button" class="btn btn-outline-secondary border-start-0" id="toggleConfirmPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback" id="password_confirmation-error"></div>
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary w-100 py-3" id="registerBtn">
                            <span class="spinner-border spinner-border-sm d-none" id="registerSpinner" role="status"></span>
                            <i class="fas fa-rocket me-2"></i>
                            <span id="registerText">Daftar</span>
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="text-muted mb-0">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">
                                Login Sekarang
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="text-center mb-2">
            <div class="bounce-in">
                <i class="fas fa-user-plus" style="font-size: 2.5rem; color: white; margin-bottom: 0.5rem;"></i>
                <h3 class="text-white fw-bold mb-1">Bergabunglah!</h3>
                <p class="text-white-50 small">Mulai perjalanan penemuan diri Anda hari ini</p>
            </div>
        </div>

        <div class="card slide-in-left">
            <div class="card-body p-4">
                <div class="text-center mb-3">
                    <h4 class="fw-bold text-primary mb-1">Daftar</h4>
                </div>

                <div id="alert-container" class="mb-3"></div>

                <form id="registerForm">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold small">Nama</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-user text-muted"></i>
                            </span>
                            <input type="text" name="name" id="name" class="form-control border-start-0 py-2"
                                value="{{ old('name') }}" placeholder="Nama lengkap" required>
                        </div>
                        <div class="invalid-feedback" id="name-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold small">Email</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-envelope text-muted"></i>
                            </span>
                            <input type="email" name="email" id="email" class="form-control border-start-0 py-2"
                                value="{{ old('email') }}" placeholder="Email aktif" required>
                        </div>
                        <div class="invalid-feedback" id="email-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold small">Password</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-lock text-muted"></i>
                            </span>
                            <input type="password" name="password" id="password" class="form-control border-start-0 py-2"
                                placeholder="Minimal 8 karakter" required>
                            <button type="button" class="btn btn-outline-secondary border-start-0 btn-sm" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback" id="password-error"></div>
                        <div class="password-strength mt-2" id="passwordStrength"></div>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-semibold small">Ulangi Password</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-check-circle text-muted"></i>
                            </span>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control border-start-0 py-2" placeholder="Konfirmasi password" required>
                            <button type="button" class="btn btn-outline-secondary border-start-0 btn-sm" id="toggleConfirmPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback" id="password_confirmation-error"></div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100 py-2 btn-sm" id="registerBtn">
                            <span class="spinner-border spinner-border-sm d-none" id="registerSpinner" role="status"></span>
                            <i class="fas fa-rocket me-1"></i>
                            <span id="registerText">Daftar</span>
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="text-muted small mb-0">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Login Sekarang</a>
                        </p>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = this;
        const registerBtn = document.getElementById('registerBtn');
        const spinner = document.getElementById('registerSpinner');
        const registerText = document.getElementById('registerText');
        const alertContainer = document.getElementById('alert-container');
        
        // Reset previous errors
        clearErrors();
        clearAlerts();
        
        // Show loading state
        registerBtn.disabled = true;
        spinner.classList.remove('d-none');
        registerText.textContent = 'Memproses...';
        
        const formData = new FormData(form);
        const data = {
            name: formData.get('name'),
            email: formData.get('email'),
            password: formData.get('password'),
            password_confirmation: formData.get('password_confirmation')
        };
        
        fetch('/api/register', {
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

                showAlert('Registrasi berhasil!', 'success');
                registerText.textContent = 'Berhasil!';
                
                // Add success animation
                registerBtn.classList.add('btn-success');
                // Login otomatis setelah register
                // fetch('/api/login', {
                //     method: 'POST',
                //     headers: { 'Content-Type': 'application/json' },
                //     body: JSON.stringify({ email: formData.get('email'), password: formData.get('password') })
                // })
                // .then(res => res.json())
                // .then(loginData => {
                //     if (loginData.success && loginData.token) {
                //         localStorage.setItem('jwt_token', loginData.token);
                //         window.location.href = '/dashboard';
                //     } else {
                //         showAlert('Login otomatis gagal, silakan login manual.', 'warning');
                //         setTimeout(() => { window.location.href = '/login'; }, 2000);
                //     }
                // });
                // form.reset();
                setTimeout(() => {
                    window.location.href = '/dashboard';
                }, 1500);
            } else {
                if (data.errors) {
                    // Handle validation errors
                    Object.keys(data.errors).forEach(field => {
                        const input = document.getElementById(field);
                        const errorDiv = document.getElementById(field + '-error');
                        if (input && errorDiv) {
                            input.classList.add('is-invalid');
                            errorDiv.textContent = data.errors[field][0];
                        }
                    });
                } else {
                    showAlert((data.message || 'Registrasi gagal'), 'danger');
                }
                registerText.textContent = 'Daftar';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Terjadi kesalahan pada server', 'danger');
            registerText.textContent = 'Mulai Petualangan';
        })
        .finally(() => {
            // Reset loading state
            registerBtn.disabled = false;
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

    // Toggle confirm password visibility
    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password_confirmation');
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

    // Password strength indicator
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const strengthDiv = document.getElementById('passwordStrength');
        let strength = 0;
        let message = '';
        let color = '';

        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/)) strength++;
        if (password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;

        switch(strength) {
            case 0:
            case 1:
                message = 'Sangat Lemah';
                color = 'danger';
                break;
            case 2:
                message = 'Lemah';
                color = 'warning';
                break;
            case 3:
                message = 'Sedang';
                color = 'info';
                break;
            case 4:
                message = 'Kuat';
                color = 'success';
                break;
            case 5:
                message = 'Sangat Kuat';
                color = 'success';
                break;
        }

        if (password.length > 0) {
            strengthDiv.innerHTML = `
                <div class="d-flex align-items-center">
                    <div class="progress flex-grow-1 me-2" style="height: 8px;">
                        <div class="progress-bar bg-${color}" style="width: ${(strength/5)*100}%"></div>
                    </div>
                    <small class="text-${color} fw-bold">${message}</small>
                </div>
            `;
        } else {
            strengthDiv.innerHTML = '';
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
</script>
@endsection
