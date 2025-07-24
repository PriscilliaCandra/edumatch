@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-success text-white text-center py-4">
                    <h2 class="mb-0 fw-bold">Hasil Tes Minat & Bakat RIASEC</h2>
                    <p class="mb-0">Selamat, {{ Auth::user()->name }}! Inilah profil minat dan bakatmu.</p>
                </div>
                <div class="card-body p-5">
                    @if ($userResult)
                        <h4 class="text-center text-primary mb-4">Tipe Kepribadianmu: <span class="badge bg-primary fs-3">{{ $userResult->personality_type }}</span></h4>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <div class="card bg-light h-100">
                                    <div class="card-body">
                                        <h5 class="card-title text-secondary">Skor RIASEC</h5>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Realistic (R)
                                                <span class="badge bg-dark rounded-pill">{{ $userResult->score_realistic }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Investigative (I)
                                                <span class="badge bg-dark rounded-pill">{{ $userResult->score_investigative }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Artistic (A)
                                                <span class="badge bg-dark rounded-pill">{{ $userResult->score_artistic }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Social (S)
                                                <span class="badge bg-dark rounded-pill">{{ $userResult->score_social }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Enterprising (E)
                                                <span class="badge bg-dark rounded-pill">{{ $userResult->score_enterprising }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Conventional (C)
                                                <span class="badge bg-dark rounded-pill">{{ $userResult->score_conventional }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card bg-light h-100">
                                    <div class="card-body">
                                        <h5 class="card-title text-secondary">Rekomendasi Jurusan</h5>
                                        <p class="card-text">{{ $userResult->recommended_majors }}</p>
                                        <small class="text-muted">Rekomendasi ini adalah panduan. Jelajahi lebih lanjut bidang-bidang yang Anda minati!</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg"><i class="fas fa-home me-2"></i>Kembali ke Dashboard</a>
                        </div>
                    @else
                        <div class="alert alert-warning text-center fs-5" role="alert">
                            Maaf, hasil tes Anda tidak ditemukan. Mungkin Anda belum menyelesaikan tes atau ada kesalahan.
                            <br>
                            <a href="{{ route('riasec.test') }}" class="btn btn-warning mt-3">Mulai Tes RIASEC</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection