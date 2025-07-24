@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card bounce-in">
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <div class="position-relative d-inline-block">
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center"
                             style="width: 100px; height: 100px; background: var(--gradient-primary);">
                            <i class="fas fa-user text-white" style="font-size: 3rem;"></i>
                        </div>
                        <div class="position-absolute top-0 end-0 bg-success rounded-circle d-flex align-items-center justify-content-center"
                             style="width: 30px; height: 30px;">
                            <i class="fas fa-check text-white"></i>
                        </div>
                    </div>
                </div>
                <h4 class="fw-bold mb-1" id="userName"></h4>
                <p class="text-muted mb-3" id="userEmail"></p>

                <button class="btn btn-danger w-100" onclick="auth.logout()">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card mb-4 slide-in-right">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h3 class="fw-bold text-primary mb-2">
                            <i class="fas fa-sun me-2"></i>Selamat Pagi, <span id="userNameGreeting"></span>!
                        </h3>
                        <p class="text-muted mb-0">Siap untuk menemukan minat dan bakat Anda hari ini?</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100 slide-in-left" style="animation-delay: 0.1s;">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto"
                                 style="width: 80px; height: 80px; background: var(--gradient-primary);">
                                <i class="fas fa-brain text-white" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-2">Tes Minat Bakat</h5>
                        <p class="text-muted mb-3">Mulai tes untuk mengetahui minat dan bakat Anda dengan analisis mendalam.</p>
                        <button class="btn btn-primary w-100" onclick="startTest()">
                            <i class="fas fa-play me-2"></i>Mulai Tes
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100 slide-in-right" style="animation-delay: 0.2s;">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <div class="rounded-circle bg-success d-flex align-items-center justify-content-center mx-auto"
                                 style="width: 80px; height: 80px; background: var(--gradient-success);">
                                <i class="fas fa-history text-white" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-2">Riwayat Tes</h5>
                        <p class="text-muted mb-3">Lihat hasil tes yang telah Anda kerjakan dan perkembangan Anda.</p>
                        <button class="btn btn-success w-100" onclick="viewHistory()">
                            <i class="fas fa-chart-line me-2"></i>Lihat Riwayat
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100 slide-in-left" style="animation-delay: 0.3s;">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center mx-auto"
                                 style="width: 80px; height: 80px; background: var(--gradient-warning);">
                                <i class="fas fa-trophy text-white" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-2">Pencapaian</h5>
                        <p class="text-muted mb-3">Kumpulkan badge dan pencapaian untuk membuktikan kemajuan Anda.</p>
                        <button class="btn btn-warning w-100" onclick="viewAchievements()">
                            <i class="fas fa-medal me-2"></i>Lihat Pencapaian
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100 slide-in-right" style="animation-delay: 0.4s;">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <div class="rounded-circle bg-danger d-flex align-items-center justify-content-center mx-auto"
                                 style="width: 80px; height: 80px; background: var(--gradient-danger);">
                                <i class="fas fa-cog text-white" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-2">Pengaturan</h5>
                        <p class="text-muted mb-3">Atur profil dan preferensi akun Anda sesuai kebutuhan.</p>
                        <button class="btn btn-danger w-100" onclick="openSettings()">
                            <i class="fas fa-sliders-h me-2"></i>Pengaturan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const auth = {
    getUser: function() {
        const user = localStorage.getItem('user');
        return user ? JSON.parse(user) : null;
    },
    getToken: function() {
        return localStorage.getItem('jwt_token');
    },
    logout: function() {
        localStorage.removeItem('jwt_token');
        localStorage.removeItem('user');
        window.location.href = '/login';
    }
};

document.addEventListener('DOMContentLoaded', function() {
    const user = auth.getUser();
    const token = auth.getToken();
    if (user && token) {
        document.getElementById('userName').textContent = user.name;
        document.getElementById('userEmail').textContent = user.email;
        document.getElementById('userNameGreeting').textContent = user.name.split(' ')[0];
    } else {
        window.location.href = '/login';
    }
});

    function startTest() {
        // Add loading animation
        const btn = event.target;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memuat...';
        btn.disabled = true;
        setTimeout(() => {
            window.location.href = '{{ route('riasec.test') }}';
        }, 800);
    }

    function viewHistory() {
        const btn = event.target;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memuat...';
        btn.disabled = true;

        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
            alert('Fitur riwayat akan segera tersedia!');
        }, 2000);
    }

    function viewAchievements() {
        const btn = event.target;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memuat...';
        btn.disabled = true;

        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
            alert('Fitur pencapaian akan segera tersedia!');
        }, 2000);
    }

    function openSettings() {
        const btn = event.target;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memuat...';
        btn.disabled = true;

        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
            alert('Fitur pengaturan akan segera tersedia!');
        }, 2000);
    }
</script>