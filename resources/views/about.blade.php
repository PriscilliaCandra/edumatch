@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card slide-in-left shadow-sm border-0">
        <div class="card-body p-4">
            <h2 class="fw-bold text-primary mb-3 text-center">Tentang <span class="text-dark">EduMatch</span></h2>
            <p class="text-muted" style="font-size: 1.05rem;">
                <strong>EduMatch</strong> adalah platform interaktif yang dirancang untuk membantu pengguna mengenali minat dan bakat mereka melalui tes RIASEC. Kami menyediakan analisis mendalam serta rekomendasi jurusan berdasarkan kepribadian dan tujuan karier Anda.
            </p>
            <p class="text-muted" style="font-size: 1.05rem;">
                Dengan fitur chatbot pintar dan interface yang ramah pengguna, EduMatch hadir untuk mendampingi perjalanan pengembangan diri Anda secara holistik.
            </p>
            <p class="text-muted" style="font-size: 1.05rem;">
                Kami percaya bahwa setiap individu memiliki potensi unik yang patut ditemukan dan dikembangkan.
            </p>

            <hr class="my-4">

            <h4 class="fw-bold text-center mb-4">Tim Pengembang</h4>
            <div class="row justify-content-center">
                @php
                    $team = [
                        ['name' => 'Priscillia Lovemel Candra', 'email' => 'priscillia.candra@binus.ac.id'],
                        ['name' => 'Nicholas Justin Tanuwijaya', 'email' => 'nicholas.tanuwijaya001@binus.ac.id'],
                        ['name' => 'Muhammad Alvaro Tristan Wijayanto', 'email' => 'muhammad.wijayanto@binus.ac.id'],
                    ];
                @endphp

                @foreach($team as $member)
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm text-center border-0 slide-in-up">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-user-circle fa-3x text-primary"></i>
                            </div>
                            <h6 class="fw-bold mb-1">{{ $member['name'] }}</h6>
                            <p class="text-muted small mb-0">
                                <i class="fas fa-envelope me-2"></i>{{ $member['email'] }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                    <i class="fas fa-home me-2"></i>Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
