@extends('layouts.app')

@section('content')
<div class="row mx-2 my-3">
    <div class="col-lg-4 mb-4">
        <div class="card bounce-in">
            <div class="card-body text-center p-3">
                <div class="mb-2">
                    <div class="position-relative d-inline-block">
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center"
                            style="width: 90px; height: 90px; background: var(--gradient-primary);">
                            <i class="fas fa-user text-white" style="font-size: 2.5rem;"></i>
                        </div>
                        <div class="position-absolute top-0 end-0 bg-success rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 26px; height: 26px;">
                            <i class="fas fa-check text-white" style="font-size: 0.8rem;"></i>
                        </div>
                    </div>
                </div>
                <h5 class="fw-bold mb-1" id="userName" style="font-size: 1.05rem;"></h5>
                <p class="text-muted mb-2" id="userEmail" style="font-size: 0.9rem;"></p>

                <button class="btn btn-danger btn-sm w-100" onclick="auth.logout()">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card mb-4 slide-in-right">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="fw-bold text-primary mb-1" style="font-size: 1.3rem;">
                            Selamat Datang di EduMatch, <span id="userNameGreeting"></span>!
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 0.95rem;">Siap untuk menemukan minat dan bakat Anda
                            hari ini?</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @php
                $features = [
                    ['icon' => 'brain', 'color' => 'primary', 'title' => 'Tes Minat Bakat', 'desc' => 'Mulai tes untuk mengetahui minat dan bakat Anda dengan analisis mendalam', 'action' => 'startTest()', 'btnClass' => 'btn-primary', 'btnText' => 'Mulai Tes', 'btnIcon' => 'play', 'delay' => '0.1s'],
                    ['icon' => 'history', 'color' => 'success', 'title' => 'Riwayat Tes', 'desc' => 'Lihat hasil rekomendasi jurusan bedasarkan hasil test minat dan bakat Anda', 'action' => 'goToResult()', 'btnClass' => 'btn-success', 'btnText' => 'Lihat Riwayat', 'btnIcon' => 'chart-line', 'delay' => '0.2s'],
                    ['icon' => 'robot', 'color' => 'warning', 'title' => 'Fitur Chatbot', 'desc' => 'Gunakan chatbot untuk tanya jawab dan bantuan interakti.', 'action' => 'goToChatbot()', 'btnClass' => 'btn-warning', 'btnText' => 'Buka Chatbot', 'btnIcon' => 'comments', 'delay' => '0.3s'],
                    ['icon' => 'cog', 'color' => 'danger', 'title' => 'Pengaturan', 'desc' => 'Atur profil dan preferensi akun Anda sesuai kebutuhan', 'action' => 'openSettings()', 'btnClass' => 'btn-danger', 'btnText' => 'Pengaturan', 'btnIcon' => 'sliders-h', 'delay' => '0.4s'],
                ];
            @endphp

            @foreach($features as $feature)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 slide-in-{{ $loop->iteration % 2 == 0 ? 'right' : 'left' }}"
                        style="animation-delay: {{ $feature['delay'] }};">
                        <div class="card-body p-3 text-center">
                            <div class="mb-2">
                                <div class="rounded-circle bg-{{ $feature['color'] }} d-flex align-items-center justify-content-center mx-auto"
                                    style="width: 70px; height: 70px; background: var(--gradient-{{ $feature['color'] }});">
                                    <i class="fas fa-{{ $feature['icon'] }} text-white" style="font-size: 1.6rem;"></i>
                                </div>
                            </div>
                            <h6 class="fw-bold mb-2" style="font-size: 1.05rem;">{{ $feature['title'] }}</h6>
                            <p class="text-muted mb-3" style="font-size: 0.9rem;">{{ $feature['desc'] }}</p>
                            <button class="btn {{ $feature['btnClass'] }} w-100" onclick="{{ $feature['action'] }}">
                                <i class="fas fa-{{ $feature['btnIcon'] }} me-2"></i>{{ $feature['btnText'] }}
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    const auth = {
        getUser: function () {
            const user = localStorage.getItem('user');
            return user ? JSON.parse(user) : null;
        },
        getToken: function () {
            return localStorage.getItem('jwt_token');
        },
        logout: function () {
            localStorage.removeItem('jwt_token');
            localStorage.removeItem('user');
            window.location.href = '/login';
        }
    };

    document.addEventListener('DOMContentLoaded', function () {
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
        const btn = event.target;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memuat...';
        btn.disabled = true;
        setTimeout(() => {
            window.location.href = '{{ route('riasec.test') }}';
        }, 800);
    }

    function goToResult() {
        const btn = event.target;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memuat...';
        btn.disabled = true;

        setTimeout(() => {
            window.location.href = '{{ route('riasec.result') }}';
        }, 800);
    }

    function goToChatbot() {
        const btn = event.target;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memuat...';
        btn.disabled = true;

        setTimeout(() => {
            window.location.href = '{{ route('chatbot') }}';
        }, 800);
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