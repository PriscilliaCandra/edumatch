@extends('layouts.app')

@section('content')
<!-- <div class="text-center mb-5">
    <div class="bounce-in">
        <i class="fas fa-graduation-cap" style="font-size: 5rem; color: white; margin-bottom: 2rem;"></i>
        <h1 class="text-white fw-bold mb-3" style="font-size: 3.5rem;">EduMatch</h1>
        <p class="text-white-50 mb-4" style="font-size: 1.2rem; max-width: 600px; margin: 0 auto;">
            Platform tes minat bakat terdepan yang membantu Anda menemukan potensi diri melalui analisis mendalam dan rekomendasi yang tepat.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 py-3">
                <i class="fas fa-rocket me-2"></i>Mulai Sekarang
            </a>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5 py-3">
                <i class="fas fa-sign-in-alt me-2"></i>Masuk
            </a>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-4 mb-4">
        <div class="card h-100 slide-in-left" style="animation-delay: 0.1s;">
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto"
                         style="width: 80px; height: 80px; background: var(--gradient-primary);">
                        <i class="fas fa-brain text-white" style="font-size: 2rem;"></i>
                    </div>
                </div>
                <h5 class="fw-bold mb-3">Tes Minat Bakat</h5>
                <p class="text-muted">Tes yang dirancang dalam bentuk gamifikasi untuk mengidentifikasi minat dan bakat Anda</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100 slide-in-left" style="animation-delay: 0.2s;">
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <div class="rounded-circle bg-success d-flex align-items-center justify-content-center mx-auto"
                         style="width: 80px; height: 80px; background: var(--gradient-success);">
                        <i class="fas fa-chart-line text-white" style="font-size: 2rem;"></i>
                    </div>
                </div>
                <h5 class="fw-bold mb-3">Analisis Mendalam</h5>
                <p class="text-muted">Dapatkan analisis komprehensif dengan rekomendasi yang detail untuk masa depan Anda</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100 slide-in-left" style="animation-delay: 0.3s;">
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center mx-auto"
                         style="width: 80px; height: 80px; background: var(--gradient-warning);">
                        <i class="fas fa-robot text-white" style="font-size: 2rem;"></i>
                    </div>
                </div>
                <h5 class="fw-bold mb-3">Chatbot Kuliah</h5>
                <p class="text-muted">Nikmati fitur chatbot untuk bertanya seputar dunia perkuliahan</p>
            </div>
        </div>
    </div>
</div>

<div class="card mb-5 slide-in-right">
    <div class="card-body p-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary mb-3">Bagaimana Cara Kerjanya?</h2>
            <p class="text-muted">Hanya dalam 3 langkah sederhana, Anda bisa menemukan minat dan bakat Anda</p>
        </div>

        <div class="row">
            <div class="col-md-4 text-center mb-4">
                <div class="position-relative">
                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width: 100px; height: 100px; background: var(--gradient-primary);">
                        <span class="text-white fw-bold" style="font-size: 2rem;">1</span>
                    </div>
                    <h5 class="fw-bold mb-2">Daftar & Login</h5>
                    <p class="text-muted">Buat akun gratis dan login ke platform kami</p>
                </div>
            </div>

            <div class="col-md-4 text-center mb-4">
                <div class="position-relative">
                    <div class="rounded-circle bg-success d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width: 100px; height: 100px; background: var(--gradient-success);">
                        <span class="text-white fw-bold" style="font-size: 2rem;">2</span>
                    </div>
                    <h5 class="fw-bold mb-2">Ikuti Tes</h5>
                    <p class="text-muted">Jawab pertanyaan tes minat bakat dengan jujur</p>
                </div>
            </div>

            <div class="col-md-4 text-center mb-4">
                <div class="position-relative">
                    <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width: 100px; height: 100px; background: var(--gradient-warning);">
                        <span class="text-white fw-bold" style="font-size: 2rem;">3</span>
                    </div>
                    <h5 class="fw-bold mb-2">Dapatkan Hasil</h5>
                    <p class="text-muted">Lihat analisis dan rekomendasi untuk masa depan Anda</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-center">
    <div class="card slide-in-left">
        <div class="card-body p-5">
            <h2 class="fw-bold text-primary mb-3">Siap Memulai Petualangan?</h2>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 py-3">
                    <i class="fas fa-rocket me-2"></i>Daftar Gratis
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg px-5 py-3">
                    <i class="fas fa-sign-in-alt me-2"></i>Sudah Punya Akun?
                </a>
            </div>
        </div>
    </div>
</div> -->

<div class="text-center mb-4">
    <div class="bounce-in">
        <i class="fas fa-graduation-cap" style="font-size: 3rem; color: white; margin-bottom: 1rem;"></i>
        <h1 class="text-white fw-bold mb-2" style="font-size: 2.5rem;">EduMatch</h1>
        <p class="text-white-50 mb-3" style="font-size: 1rem; max-width: 500px; margin: 0 auto;">
            Platform tes minat bakat terdepan yang membantu Anda menemukan potensi diri melalui analisis mendalam dan rekomendasi yang tepat.
        </p>
        <div class="d-flex justify-content-center gap-2 flex-wrap">
            <a href="{{ route('register') }}" class="btn btn-primary btn-md px-4 py-2">
                <i class="fas fa-rocket me-1"></i>Mulai Sekarang
            </a>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-md px-4 py-2">
                <i class="fas fa-sign-in-alt me-1"></i>Masuk
            </a>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card h-100 slide-in-left" style="animation-delay: 0.1s;">
            <div class="card-body text-center p-3">
                <div class="mb-2">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto"
                         style="width: 60px; height: 60px; background: var(--gradient-primary);">
                        <i class="fas fa-brain text-white" style="font-size: 1.5rem;"></i>
                    </div>
                </div>
                <h6 class="fw-bold mb-2">Tes Minat Bakat</h6>
                <p class="text-muted small">Tes dalam bentuk gamifikasi untuk mengidentifikasi minat dan bakat Anda</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card h-100 slide-in-left" style="animation-delay: 0.2s;">
            <div class="card-body text-center p-3">
                <div class="mb-2">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto"
                         style="width: 60px; height: 60px; background: var(--gradient-success);">
                        <i class="fas fa-chart-line text-white" style="font-size: 1.5rem;"></i>
                    </div>
                </div>
                <h6 class="fw-bold mb-2">Analisis Mendalam</h6>
                <p class="text-muted small">Analisis komprehensif dan rekomendasi untuk masa depan Anda</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card h-100 slide-in-left" style="animation-delay: 0.3s;">
            <div class="card-body text-center p-3">
                <div class="mb-2">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto"
                         style="width: 60px; height: 60px; background: var(--gradient-warning);">
                        <i class="fas fa-robot text-white" style="font-size: 1.5rem;"></i>
                    </div>
                </div>
                <h6 class="fw-bold mb-2">Chatbot Kuliah</h6>
                <p class="text-muted small">Fitur chatbot untuk bertanya seputar dunia perkuliahan</p>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4 slide-in-right">
    <div class="card-body p-4">
        <div class="text-center mb-4">
            <h4 class="fw-bold text-primary mb-2">Bagaimana Cara Kerjanya?</h4>
            <p class="text-muted small">Hanya dalam 3 langkah sederhana, Anda bisa menemukan minat dan bakat Anda</p>
        </div>

        <div class="row">
            <div class="col-md-4 text-center mb-3">
                <div class="position-relative">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                         style="width: 70px; height: 70px; background: var(--gradient-primary);">
                        <span class="text-white fw-bold" style="font-size: 1.5rem;">1</span>
                    </div>
                    <h6 class="fw-bold mb-1">Daftar & Login</h6>
                    <p class="text-muted small">Buat akun gratis dan login ke platform kami</p>
                </div>
            </div>

            <div class="col-md-4 text-center mb-3">
                <div class="position-relative">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                         style="width: 70px; height: 70px; background: var(--gradient-success);">
                        <span class="text-white fw-bold" style="font-size: 1.5rem;">2</span>
                    </div>
                    <h6 class="fw-bold mb-1">Ikuti Tes</h6>
                    <p class="text-muted small">Jawab pertanyaan tes minat bakat dengan jujur</p>
                </div>
            </div>

            <div class="col-md-4 text-center mb-3">
                <div class="position-relative">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                         style="width: 70px; height: 70px; background: var(--gradient-warning);">
                        <span class="text-white fw-bold" style="font-size: 1.5rem;">3</span>
                    </div>
                    <h6 class="fw-bold mb-1">Dapatkan Hasil</h6>
                    <p class="text-muted small">Lihat analisis dan rekomendasi untuk masa depan Anda</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-center">
    <div class="card slide-in-left">
        <div class="card-body p-4">
            <h4 class="fw-bold text-primary mb-2">Siap Memulai Petualangan?</h4>
            <div class="d-flex justify-content-center gap-2 flex-wrap">
                <a href="{{ route('register') }}" class="btn btn-primary btn-md px-4 py-2">
                    <i class="fas fa-rocket me-1"></i>Daftar Gratis
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-md px-4 py-2">
                    <i class="fas fa-sign-in-alt me-1"></i>Sudah Punya Akun?
                </a>
            </div>
        </div>
    </div>
</div>


<script>
    // Add scroll animations
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        }, observerOptions);

        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            observer.observe(card);
        });
    });
</script>
@endsection
