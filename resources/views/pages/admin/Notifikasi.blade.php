<!-- resources/views/admin/notifications/create.blade.php -->  
@extends('layouts.admin.main')  
@section('title', 'Admin Notifikasi')  
@section('content')  
<div class="main-content">  
    <section class="section">  
        <div class="section-header" style="background: var(--nb-surface); border: 1px solid var(--nb-border); box-shadow: var(--nb-shadow-sm); border-radius: 8px; border-left: 4px solid var(--nb-primary);">  
            <h1 style="font-family: var(--nb-font-display);">Tambah Notifikasi</h1>  
            <div class="section-header-breadcrumb">  
                <div class="breadcrumb-item active"><a href="#" style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink);">Notifikasi</a></div>  
                <div class="breadcrumb-item" style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink);">Tambah</div>  
            </div>  
        </div>  
        
        <div class="card nb-card" style="background: var(--nb-surface);">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="border: var(--nb-border);">
                        <thead style="background: var(--nb-soft); border-bottom: var(--nb-border);">
                            <tr>
                                <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">#</th>
                                <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Nama User</th>
                                <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Nama Mitra</th>
                                <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Isi Pesan</th>
                                <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Tanggal</th>
                                <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Jenis</th>
                                <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notifications as $notification)
                                <tr>
                                    <td style="border: var(--nb-border); font-weight: 500;">{{ $loop->iteration }}</td>
                                    <td style="border: var(--nb-border); font-weight: 500;">{{ $notification->user_name ?? '-' }}</td>
                                    <td style="border: var(--nb-border); font-weight: 500;">{{ $notification->mitra_name ?? '-' }}</td>
                                    <td style="border: var(--nb-border); font-weight: 500;">{{ $notification->isi_pesan }}</td>
                                    <td style="border: var(--nb-border); font-weight: 500;">{{ $notification->tanggal }}</td>
                                    <td style="border: var(--nb-border); font-weight: 500;">{{ $notification->jenis }}</td>
                                    <td style="border: var(--nb-border); font-weight: 500;">{{ $notification->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card nb-card" style="background: var(--nb-paper); margin-top: 2rem;">  
            <div class="card-header" style="border-bottom: var(--nb-border);">
                <h4 style="font-family: var(--nb-font-display); font-size: 1.5rem;">Buat Notifikasi Baru</h4>
            </div>
            <div class="card-body" style="padding: 30px;">
                <form action="{{ route('notifications.store') }}" method="POST">  
                    @csrf  
                    <div class="form-group">  
                        <label for="id_user" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Nama User</label>  
                        <select class="form-control nb-input" id="id_user" name="id_user">  
                            <option value="">Pilih User</option>  
                            @foreach($notifications as $notification)  
                                <option value="{{ $notification->id }}">{{ $notification->user_name }}</option>  
                            @endforeach  
                        </select>  
                    </div>  
                    <div class="form-group">  
                        <label for="id_mitra" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Nama Mitra</label>  
                        <select class="form-control nb-input" id="id_mitra" name="id_mitra">  
                            <option value="">Pilih Mitra</option>  
                            @foreach($notifications as $notification)
                                <option value="{{ $notification->id }}">{{ $notification->mitra_name }}</option>  
                            @endforeach  
                        </select>  
                    </div>  
                    <div class="form-group">  
                        <label for="isi_pesan" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Isi Pesan</label>  
                        <textarea class="form-control nb-input" id="isi_pesan" name="isi_pesan" rows="3" required></textarea>  
                    </div>  
                    <div class="form-group">  
                        <label for="tanggal" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Tanggal</label>  
                        <input type="date" class="form-control nb-input" id="tanggal" name="tanggal" required>  
                    </div>  
                    <div class="form-group">  
                        <label for="jenis" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Jenis</label>  
                        <input type="text" class="form-control nb-input" id="jenis" name="jenis" required>  
                    </div>  
                    <button type="submit" class="nb-btn btn-primary" style="font-size: 1.1rem; padding: 12px 24px;">Simpan</button>  
                </form>  
            </div>
        </div>  
    </section>  
</div>  
@endsection  

