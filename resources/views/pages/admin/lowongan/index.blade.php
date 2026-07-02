@extends('layouts.admin.main') 
@section('title', 'Manajemen Lowongan') 
@section('content') 
    <div class="main-content"> 
        <section class="section"> 
            <div class="section-header" style="background: var(--nb-surface); border: 1px solid var(--nb-border); box-shadow: var(--nb-shadow-sm); border-radius: 8px; border-left: 4px solid var(--nb-primary);"> 
                <h1 style="font-family: var(--nb-font-display);">Manajemen Lowongan</h1> 
                <div class="section-header-breadcrumb"> 
                    <div class="breadcrumb-item active"><a href="#" style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink);">Manajemen Lowongan</a></div> 
                </div> 
            </div> 
            <div class="row"> 
                <div class="col-12"> 
                    <div class="row"> 
                        @foreach($lamarans as $lamaran) 
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4"> 
                                <div class="card nb-card" style="background: var(--nb-paper); height: 100%;"> 
                                    <div class="card-body d-flex flex-column"> 
                                        <h5 class="card-title" style="font-family: var(--nb-font-display); font-size: 1.25rem;">{{ $lamaran->nama_lowongan }}</h5> 
                                        <p class="card-text flex-grow-1" style="font-weight: 500;">Nama Freelancer: {{ $lamaran->name }}</p> 
                                        <p class="card-text mb-4">Status: 
                                            <span style="background: {{ $lamaran->status == 'aktif' ? 'var(--nb-success)' : 'var(--nb-danger)' }}; color: var(--nb-paper); padding: 4px 10px; border: var(--nb-border); font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">
                                                {{ ucfirst($lamaran->status) }}
                                            </span>
                                        </p>
                                        <div class="d-flex justify-content-between mt-auto"> 
                                            <a href="{{ route('admin.lowongan.detail', $lamaran->id) }}"><button class="nb-btn btn-primary">Detail</button></a>
                                            <form action="#" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lamaran ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="nb-btn btn-danger">Hapus</button> 
                                            </form>
                                        </div> 
                                    </div> 
                                </div> 
                            </div> 
                            @endforeach
                    </div> 
                </div> 
            </div> 
        </section> 
    </div> 

@endsection 

