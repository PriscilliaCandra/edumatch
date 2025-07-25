@extends('layouts.app')

@section('content')
<div class="container py-3" style="height: 100vh; overflow: hidden;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-lg" style="max-height: 90vh; overflow-y: auto;">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h2 class="mb-0 fw-bold">Hasil Tes Minat & Bakat RIASEC Anda</h2>
                    <p class="mb-0" id="userNameDisplay">Memuat nama...</p>
                </div>
                <div class="card-body p-5">
                    <div id="loadingMessage" class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted">Memuat hasil tes...</p>
                    </div>
                    <div id="errorMessage" class="alert alert-danger mt-4" style="display: none;"></div>

                    <div id="resultContent" style="display: none;">
                        <h4 class="text-center text-primary mb-4">Tipe Kepribadianmu: <span class="badge bg-primary fs-3" id="personalityType"></span></h4>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <div class="card bg-light h-100">
                                    <div class="card-body">
                                        <h5 class="card-title text-secondary">Skor RIASEC</h5>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Realistic (R)
                                                <span class="badge bg-dark rounded-pill" id="scoreR"></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Investigative (I)
                                                <span class="badge bg-dark rounded-pill" id="scoreI"></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Artistic (A)
                                                <span class="badge bg-dark rounded-pill" id="scoreA"></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Social (S)
                                                <span class="badge bg-dark rounded-pill" id="scoreS"></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Enterprising (E)
                                                <span class="badge bg-dark rounded-pill" id="scoreE"></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Conventional (C)
                                                <span class="badge bg-dark rounded-pill" id="scoreC"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card bg-light h-100">
                                    <div class="card-body">
                                        <h5 class="card-title text-secondary">Rekomendasi Jurusan</h5>
                                        <p class="card-text" id="recommendedMajors"></p>
                                        <small class="text-muted">Rekomendasi ini adalah panduan. Jelajahi lebih lanjut bidang-bidang yang Anda minati!</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <div class="text-center mt-5">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg"><i class="fas fa-home me-2"></i>Kembali ke Dashboard</a>
                        <a href="{{ route('riasec.test') }}" class="btn btn-warning btn-lg ms-3" id="retryTestBtn" style="display: none;">
                            <i class="fas fa-redo me-2"></i>Mulai Ulang Tes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const loadingMessage = document.getElementById('loadingMessage');
    const errorMessage = document.getElementById('errorMessage');
    const resultContent = document.getElementById('resultContent');
    const userNameDisplay = document.getElementById('userNameDisplay');
    const retryTestBtn = document.getElementById('retryTestBtn');

    const personalityType = document.getElementById('personalityType');
    const scoreR = document.getElementById('scoreR');
    const scoreI = document.getElementById('scoreI');
    const scoreA = document.getElementById('scoreA');
    const scoreS = document.getElementById('scoreS');
    const scoreE = document.getElementById('scoreE');
    const scoreC = document.getElementById('scoreC');
    const recommendedMajors = document.getElementById('recommendedMajors');

    const storedUser = localStorage.getItem('user');
    if (storedUser) {
        try {
            const user = JSON.parse(storedUser);
            userNameDisplay.textContent = `Selamat, ${user.name}! Inilah profil minat dan bakatmu.`;
        } catch (e) {
            console.error("Error parsing user data from localStorage:", e);
            userNameDisplay.textContent = 'Selamat! Inilah profil minat dan bakatmu.';
        }
    } else {
        userNameDisplay.textContent = 'Selamat! Inilah profil minat dan bakatmu.';
    }

    function getJwtToken() {
        return localStorage.getItem('jwt_token');
    }

    async function fetchUserResult() {
        loadingMessage.style.display = 'block';
        errorMessage.style.display = 'none';
        resultContent.style.display = 'none';
        retryTestBtn.style.display = 'none';

        const token = getJwtToken();

        if (!token) {
            errorMessage.textContent = 'Anda tidak terautentikasi. Silakan login kembali.';
            errorMessage.style.display = 'block';
            loadingMessage.style.display = 'none';
            setTimeout(() => {
                window.location.href = '{{ route('login') }}';
            }, 2000);
            return;
        }

        try {
            const response = await fetch('{{ route('api.riasec.get_user_result') }}', { 
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token, 
                }
            });

            const data = await response.json();

            if (response.ok) {
                const result = data.userResult;
                if (result) {
                    personalityType.textContent = result.personality_type;
                    scoreR.textContent = result.score_realistic;
                    scoreI.textContent = result.score_investigative;
                    scoreA.textContent = result.score_artistic;
                    scoreS.textContent = result.score_social;
                    scoreE.textContent = result.score_enterprising;
                    scoreC.textContent = result.score_conventional;
                    recommendedMajors.textContent = result.recommended_majors;
                    resultContent.style.display = 'block';
                } else {
                    errorMessage.textContent = 'Data hasil tes tidak lengkap atau tidak ditemukan.';
                    errorMessage.style.display = 'block';
                    retryTestBtn.style.display = 'inline-block';
                }
            } else {
                errorMessage.textContent = data.message || 'Gagal memuat hasil tes.';
                errorMessage.style.display = 'block';

                if (response.status === 404) {
                    retryTestBtn.style.display = 'inline-block';
                }

                if (response.status === 401) {
                    setTimeout(() => {
                        window.location.href = '{{ route('login') }}';
                    }, 2000);
                }
            }
        } catch (error) {
            console.error('Error fetching user result:', error);
            errorMessage.textContent = 'Terjadi kesalahan jaringan atau server.';
            errorMessage.style.display = 'block';
        } finally {
            loadingMessage.style.display = 'none';
        }
    }

    fetchUserResult(); 
});
</script>
@endpush