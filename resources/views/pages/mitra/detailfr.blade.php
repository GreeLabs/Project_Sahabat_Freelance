<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Freelancer</title>
    @include('layouts.mitra.style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .star-rating {
            display: flex;
            gap: 10px;
            font-size: 2rem;
            color: #FFD700;
            cursor: pointer;
            background: var(--nb-surface);
            padding: 10px 15px;
            border: var(--nb-border);
            justify-content: center;
        }
        .star-rating i {
            transition: transform 0.1s;
            color: var(--nb-ink);
        }
        .star-rating i.fas {
            color: #FFD700;
            -webkit-text-stroke: 2px var(--nb-ink);
        }
        .star-rating i.far {
            color: var(--nb-paper);
            -webkit-text-stroke: 2px var(--nb-ink);
        }
        .star-rating i:hover {
            transform: scale(1.2);
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        @include('layouts.mitra.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('layouts.mitra.sidebar')
            
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0" style="font-family: var(--nb-font-display);">Detail Freelancer</h2>
                    </div>

                    <div class="row">
                        <!-- Profile Card -->
                        <div class="col-md-12 mb-4">
                            <div class="card nb-card w-100" style="background: var(--nb-surface); padding: 30px;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="{{ asset('images/' . $freelancer->profil_picture) }}" alt="Freelancer Profile" style="width: 100%; max-height: 300px; object-fit: cover; border: var(--nb-border);">
                                    </div>
                                    <div class="col-md-9 d-flex flex-column justify-content-center">
                                        <h3 style="font-family: var(--nb-font-display); font-size: 2.5rem; margin-bottom: 10px;">{{ $freelancer->name }}</h3>
                                        <p style="font-size: 1.1rem; font-weight: 600; margin-bottom: 5px;">{{ $freelancer->keahlian ?? 'Belum ada keahlian' }}</p>
                                        <p style="margin-bottom: 15px;">{{ $freelancer->email }}</p>
                                        <p style="margin-bottom: 20px;">{{ $freelancer->deskripsi }}</p>
                                        <div>
                                            <span style="background: var(--nb-success); color: var(--nb-paper); padding: 8px 16px; border: var(--nb-border); font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Available</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rating & Reviews -->
                        <div class="col-md-12 mb-4">
                            <div class="card nb-card w-100" style="background: var(--nb-soft); padding: 30px;">
                                <h3 class="mb-4" style="font-family: var(--nb-font-display);">Rating dan Komentar</h3>
                                <div class="row">
                                    <div class="col-md-4 mb-4 mb-md-0 text-center">
                                        <h2 style="font-family: var(--nb-font-display); font-size: 3.5rem; color: var(--nb-primary); -webkit-text-stroke: 2px var(--nb-ink);">{{ $freelancer->rating ?? '0' }} / 5</h2>
                                        <p style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Jumlah Ulasan: {{ $ratings->count() }}</p>
                                        <img src="{{ asset('images/feature.png') }}" alt="Features" style="max-height: 200px; margin-top: 20px;">
                                    </div>
                                    <div class="col-md-8">
                                        @forelse ($ratings as $rating)
                                            <div class="card nb-card mb-3 w-100" style="background: var(--nb-paper); padding: 20px;">
                                                <h5 style="font-family: var(--nb-font-ui); text-transform: uppercase; margin-bottom: 5px;">Mitra: {{ $rating->id_mitra }}</h5>
                                                <div style="color: #FFD700; margin-bottom: 10px; font-size: 1.2rem;">
                                                    @for($i=1; $i<=5; $i++)
                                                        @if($i <= $rating->rating)
                                                            <i class="fas fa-star"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <p style="font-weight: 600; margin-bottom: 10px;">{{ $rating->komentar }}</p>
                                                <div>
                                                    <span style="background: var(--nb-ink); color: var(--nb-paper); padding: 4px 10px; font-size: 0.8rem; font-family: var(--nb-font-ui);">{{ $rating->tag }}</span>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center p-4" style="border: var(--nb-border); background: var(--nb-paper);">
                                                <p class="mb-0" style="font-weight: 600;">Belum ada ulasan untuk freelancer ini.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add Review Form -->
                        <div class="col-md-12">
                            <div class="card nb-card w-100" style="background: var(--nb-paper); padding: 30px;">
                                <h3 class="mb-4" style="font-family: var(--nb-font-display);">Beri Rating dan Komentar</h3>
                                <form action="{{ route('submit.rating') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_user" value="{{ $freelancer->id }}">
                                    <input type="hidden" name="id_mitra" value="{{ Auth::guard('mitra')->user()->id }}">
                                    
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase; margin-bottom: 8px; display: block;">Kualitas Kerja</label>
                                            <div class="star-rating" data-name="quality">
                                                <i class="fas fa-star" data-value="1"></i>
                                                <i class="fas fa-star" data-value="2"></i>
                                                <i class="fas fa-star" data-value="3"></i>
                                                <i class="fas fa-star" data-value="4"></i>
                                                <i class="fas fa-star" data-value="5"></i>
                                                <input type="hidden" name="quality" value="5" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase; margin-bottom: 8px; display: block;">Komunikasi</label>
                                            <div class="star-rating" data-name="communication">
                                                <i class="fas fa-star" data-value="1"></i>
                                                <i class="fas fa-star" data-value="2"></i>
                                                <i class="fas fa-star" data-value="3"></i>
                                                <i class="fas fa-star" data-value="4"></i>
                                                <i class="fas fa-star" data-value="5"></i>
                                                <input type="hidden" name="communication" value="5" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase; margin-bottom: 8px; display: block;">Ketepatan Waktu</label>
                                            <div class="star-rating" data-name="timeliness">
                                                <i class="fas fa-star" data-value="1"></i>
                                                <i class="fas fa-star" data-value="2"></i>
                                                <i class="fas fa-star" data-value="3"></i>
                                                <i class="fas fa-star" data-value="4"></i>
                                                <i class="fas fa-star" data-value="5"></i>
                                                <input type="hidden" name="timeliness" value="5" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase; margin-bottom: 8px; display: block;">Komentar</label>
                                        <textarea class="form-control nb-input" name="comment" rows="4" style="border-radius: 0; padding: 15px; font-family: var(--nb-font-body);" placeholder="Tuliskan pengalaman Anda bekerja dengan freelancer ini..."></textarea>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase; margin-bottom: 8px; display: block;">Tags</label>
                                        <select class="form-control nb-input" name="tags[]" multiple style="min-height: 100px;">
                                            <option value="Profesional">Profesional</option>
                                            <option value="Cepat">Cepat</option>
                                            <option value="Kreatif">Kreatif</option>
                                            <option value="Responsif">Responsif</option>
                                            <option value="Perlu Komunikasi Lebih Baik">Perlu Komunikasi Lebih Baik</option>
                                        </select>
                                        <small class="text-muted mt-2 d-block">Tahan tombol Ctrl (Windows) atau Command (Mac) untuk memilih lebih dari satu.</small>
                                    </div>
                                    <button type="submit" class="nb-btn btn-primary w-100 py-3" style="font-size: 1.1rem;">Kirim Ulasan</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
    @include('layouts.mitra.script')
    <script>
        document.querySelectorAll('.star-rating').forEach(container => {
            const stars = container.querySelectorAll('i');
            const input = container.querySelector('input');

            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const value = star.getAttribute('data-value');
                    input.value = value;
                    
                    stars.forEach(s => {
                        if(s.getAttribute('data-value') <= value) {
                            s.classList.remove('far');
                            s.classList.add('fas');
                        } else {
                            s.classList.remove('fas');
                            s.classList.add('far');
                        }
                    });
                });
                
                star.addEventListener('mouseover', () => {
                    const value = star.getAttribute('data-value');
                    stars.forEach(s => {
                        if(s.getAttribute('data-value') <= value) {
                            s.style.color = '#ffc107';
                        } else {
                            s.style.color = 'var(--nb-ink)';
                        }
                    });
                });
                
                star.addEventListener('mouseout', () => {
                    const value = input.value;
                    stars.forEach(s => {
                        s.style.color = ''; // reset color
                        if(s.getAttribute('data-value') <= value) {
                            s.classList.remove('far');
                            s.classList.add('fas');
                        } else {
                            s.classList.remove('fas');
                            s.classList.add('far');
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>  
