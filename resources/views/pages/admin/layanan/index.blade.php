@extends('layouts.admin.main')   
@section('title', 'Manajemen Layanan Premium')   
@section('content')   
    <div class="main-content">   
        <section class="section">   
            <div class="section-header" style="background: var(--nb-surface); border: 1px solid var(--nb-border); box-shadow: var(--nb-shadow-sm); border-radius: 8px; border-left: 4px solid var(--nb-primary);">   
                <h1 style="font-family: var(--nb-font-display);">Manajemen Layanan Premium</h1>   
                <div class="section-header-breadcrumb">   
                    <div class="breadcrumb-item active"><a href="#" style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink);">Manajemen Layanan Premium</a></div>   
                </div>   
            </div>   
  
            <!-- Daftar Layanan Premium -->  
            <div class="row">   
                <div class="col-12">   
                    <div class="card nb-card" style="background: var(--nb-surface);">   
                        <div class="card-header" style="border-bottom: var(--nb-border);">   
                            <h4 style="font-family: var(--nb-font-display); font-size: 1.5rem;">Daftar Layanan Premium</h4>   
                        </div>   
                        <div class="card-body">   
                            <div class="table-responsive">   
                                <table class="table table-bordered" style="border: var(--nb-border);">   
                                    <thead style="background: var(--nb-soft); border-bottom: var(--nb-border);">   
                                        <tr>   
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Nama Layanan</th>   
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Harga</th>   
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Deskripsi</th>   
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Status</th>   
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Aksi</th>   
                                        </tr>   
                                    </thead>   
                                    <tbody>   
                                        @foreach($services as $service)   
                                            <tr>   
                                                <td style="border: var(--nb-border); font-weight: 500;">{{ $service->name }}</td>   
                                                <td style="border: var(--nb-border); font-weight: 500;">Rp {{ number_format($service->price, 2, ',', '.') }}</td>   
                                                <td style="border: var(--nb-border); font-weight: 500;">{{ $service->description }}</td>   
                                                <td style="border: var(--nb-border);">
                                                    <span style="background: {{ $service->status == 'aktif' ? 'var(--nb-success)' : 'var(--nb-danger)' }}; color: var(--nb-paper); padding: 4px 10px; border: var(--nb-border); font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">
                                                        {{ ucfirst($service->status) }}
                                                    </span>
                                                </td>   
                                                <td style="border: var(--nb-border);">   
                                                    <button class="nb-btn btn-warning mb-2 mb-md-0 mr-md-2" data-toggle="modal" data-target="#editServiceModal{{ $service->id }}">Edit</button>   
                                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">   
                                                        @csrf   
                                                        @method('DELETE')   
                                                        <button type="submit" class="nb-btn btn-danger">Hapus</button>   
                                                    </form>   
                                                </td>   
                                            </tr>   
                                        @endforeach   
                                    </tbody>   
                                </table>   
                            </div>   
                        </div>   
                    </div>   
                </div>   
            </div>   
  
            <!-- Daftar User Premium -->  
            <div class="row">   
                <div class="col-12">   
                    <div class="card nb-card" style="background: var(--nb-surface);">   
                        <div class="card-header" style="border-bottom: var(--nb-border);">   
                            <h4 style="font-family: var(--nb-font-display); font-size: 1.5rem;">Daftar User Premium</h4>   
                        </div>   
                        <div class="card-body">   
                            <div class="table-responsive">   
                                <table class="table table-bordered" style="border: var(--nb-border);">   
                                    <thead style="background: var(--nb-cyan); border-bottom: var(--nb-border);">   
                                        <tr>   
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Nama</th>   
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Email</th>      
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Profil Picture</th>    
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Role</th>   
                                        </tr>   
                                    </thead>   
                                    <tbody>   
                                        @foreach($premiumUsers as $user)   
                                            <tr>   
                                                <td style="border: var(--nb-border); font-weight: 500;">{{ $user->name }}</td>   
                                                <td style="border: var(--nb-border); font-weight: 500;">{{ $user->email }}</td>      
                                                <td style="border: var(--nb-border);"><img src="{{ asset('images/' . $user->profil_picture) }}" alt="Profil Picture" style="width: 50px; height: 50px; border-radius: 0; border: var(--nb-border);"></td>   
                                                <td style="border: var(--nb-border); font-weight: bold; text-transform: uppercase;">{{ $user->role }}</td>   
                                            </tr>   
                                        @endforeach   
                                    </tbody>   
                                </table>   
                            </div>   
                        </div>   
                    </div>   
                </div>   
            </div>   
  
            <!-- Daftar Mitra Premium -->  
            <div class="row">   
                <div class="col-12">   
                    <div class="card nb-card" style="background: var(--nb-surface);">   
                        <div class="card-header" style="border-bottom: var(--nb-border);">   
                            <h4 style="font-family: var(--nb-font-display); font-size: 1.5rem;">Daftar Mitra Premium</h4>   
                        </div>   
                        <div class="card-body">   
                            <div class="table-responsive">   
                                <table class="table table-bordered" style="border: var(--nb-border);">   
                                    <thead style="background: var(--nb-warning); border-bottom: var(--nb-border);">   
                                        <tr>   
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Nama</th>   
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Email</th>     
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Profil Picture</th>   
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Role</th>   
                                        </tr>   
                                    </thead>   
                                    <tbody>   
                                        @foreach($premiumMitras as $mitra)   
                                            <tr>   
                                                <td style="border: var(--nb-border); font-weight: 500;">{{ $mitra->name }}</td>   
                                                <td style="border: var(--nb-border); font-weight: 500;">{{ $mitra->email }}</td>   
                                                <td style="border: var(--nb-border);"><img src="{{ asset('images/' . $mitra->profil_picture) }}" alt="Profil Picture" style="width: 50px; height: 50px; border-radius: 0; border: var(--nb-border);"></td>    
                                                <td style="border: var(--nb-border); font-weight: bold; text-transform: uppercase;">{{ $mitra->role }}</td>   
                                            </tr>   
                                        @endforeach   
                                    </tbody>   
                                </table>   
                            </div>   
                        </div>   
                    </div>   
                </div>   
            </div>   
        </section>   
    </div>   
  
    <!-- Modal Edit Layanan Premium -->  
    @foreach($services as $service)   
        <div class="modal fade" id="editServiceModal{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="editServiceModalLabel" aria-hidden="true">   
            <div class="modal-dialog" role="document">   
                <div class="modal-content" style="border: var(--nb-border); box-shadow: var(--nb-shadow-lg); border-radius: 8px;">   
                    <div class="modal-header" style="background: transparent; border-bottom: var(--nb-border); border-radius: 8px 8px 0 0;">   
                        <h5 class="modal-title" id="editServiceModalLabel" style="font-family: var(--nb-font-display); font-size: 1.5rem; margin: 0;">Edit Layanan Premium</h5>   
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 1; font-weight: bold; font-family: var(--nb-font-display);">   
                            <span aria-hidden="true">&times;</span>   
                        </button>   
                    </div>   
                    <form action="{{ route('services.update', $service->id) }}" method="POST">   
                        @csrf   
                        @method('PUT')   
                        <div class="modal-body" style="background: var(--nb-paper); padding: 25px;">   
                            <div class="form-group">   
                                <label for="serviceName" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Nama Layanan</label>   
                                <input type="text" class="form-control nb-input" id="serviceName" name="name" value="{{ $service->name }}" required>   
                            </div>   
                            <div class="form-group">   
                                <label for="servicePrice" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Harga</label>   
                                <input type="text" class="form-control nb-input" id="servicePrice" name="price" value="{{ $service->price }}" required>   
                            </div>   
                            <div class="form-group">   
                                <label for="serviceDescription" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Deskripsi</label>   
                                <textarea class="form-control nb-input" id="serviceDescription" name="description" rows="3" required>{{ $service->description }}</textarea>   
                            </div>   
                            <div class="form-group">   
                                <label for="serviceStatus" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Status</label>   
                                <select class="form-control nb-input" id="serviceStatus" name="status">   
                                    <option value="aktif" {{ $service->status == 'aktif' ? 'selected' : '' }}>Aktif</option>   
                                    <option value="nonaktif" {{ $service->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>   
                                </select>   
                            </div>   
                        </div>   
                        <div class="modal-footer" style="border-top: var(--nb-border); background: var(--nb-surface);">   
                            <button type="button" class="nb-btn btn-white" data-dismiss="modal">Tutup</button>   
                            <button type="submit" class="nb-btn btn-success">Simpan Perubahan</button>   
                        </div>   
                    </form>   
                </div>   
            </div>   
        </div>   
    @endforeach   
@endsection
