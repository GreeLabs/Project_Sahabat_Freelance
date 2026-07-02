@extends('layouts.admin.main') 
@section('title', 'Manajemen Pengguna dan Mitra') 
@section('content') 
    <div class="main-content"> 
        <section class="section"> 
            <div class="section-header" style="background: var(--nb-surface); border: 1px solid var(--nb-border); box-shadow: var(--nb-shadow-sm); border-radius: 8px; border-left: 4px solid var(--nb-primary);"> 
                <h1 style="font-family: var(--nb-font-display);">Manajemen Pengguna dan Mitra</h1> 
                <div class="section-header-breadcrumb"> 
                    <div class="breadcrumb-item active"><a href="#" style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink);">Manajemen Pengguna dan Mitra</a></div> 
                </div> 
            </div> 
            <div class="row"> 
                <div class="col-12"> 
                    <div class="card nb-card" style="background: var(--nb-surface);"> 
                        <div class="card-header" style="border-bottom: var(--nb-border);"> 
                            <h4 style="font-family: var(--nb-font-display); font-size: 1.5rem;">Daftar Pengguna</h4> 
                        </div> 
                        <div class="card-body"> 
                            <div class="table-responsive"> 
                                <table class="table table-bordered" style="border: var(--nb-border);"> 
                                    <thead style="background: var(--nb-soft); border-bottom: var(--nb-border);"> 
                                        <tr> 
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Nama</th> 
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Email</th> 
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Status</th> 
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Aksi</th> 
                                        </tr> 
                                    </thead> 
                                    <tbody> 
                                        @foreach($users as $user) 
                                            <tr> 
                                                <td style="border: var(--nb-border); font-weight: 500;">{{ $user->name }}</td> 
                                                <td style="border: var(--nb-border); font-weight: 500;">{{ $user->email }}</td> 
                                                <td style="border: var(--nb-border);">
                                                    <span style="background: {{ $user->status == 'aktif' ? 'var(--nb-success)' : 'var(--nb-danger)' }}; color: var(--nb-paper); padding: 4px 10px; border: var(--nb-border); font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">
                                                        {{ ucfirst($user->status) }}
                                                    </span>
                                                </td> 
                                                <td style="border: var(--nb-border);"> 
                                                    <button class="nb-btn btn-warning mb-2 mb-md-0 mr-md-2" data-toggle="modal" data-target="#editUserModal{{ $user->id }}">Edit</button> 
                                                    <form action="{{ route('pengguna.suspendu', $user->id) }}" method="POST" style="display:inline;"> 
                                                        @csrf 
                                                        <button type="submit" class="nb-btn btn-danger">Suspend</button> 
                                                    </form> 
                                                </td> 
                                            </tr> 
                                        @endforeach 
                                    </tbody> 
                                </table> 
                            </div> 
                            <div class="mt-4 d-flex justify-content-center">
                                {{ $users->appends(['mitras_page' => request('mitras_page')])->links('pagination::bootstrap-5') }}
                            </div>
                        </div> 
                    </div> 
                </div> 
            </div> 
            <div class="row"> 
                <div class="col-12"> 
                    <div class="card nb-card" style="background: var(--nb-surface);"> 
                        <div class="card-header" style="border-bottom: var(--nb-border);"> 
                            <h4 style="font-family: var(--nb-font-display); font-size: 1.5rem;">Daftar Mitra</h4> 
                        </div> 
                        <div class="card-body"> 
                            <div class="table-responsive"> 
                                <table class="table table-bordered" style="border: var(--nb-border);"> 
                                    <thead style="background: var(--nb-cyan); border-bottom: var(--nb-border);"> 
                                        <tr> 
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Nama</th> 
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Email</th> 
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Status</th> 
                                            <th style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink); border: var(--nb-border);">Aksi</th> 
                                        </tr> 
                                    </thead> 
                                    <tbody> 
                                        @foreach($mitras as $mitra) 
                                            <tr> 
                                                <td style="border: var(--nb-border); font-weight: 500;">{{ $mitra->name }}</td> 
                                                <td style="border: var(--nb-border); font-weight: 500;">{{ $mitra->email }}</td> 
                                                <td style="border: var(--nb-border);">
                                                    <span style="background: {{ $mitra->status == 'aktif' ? 'var(--nb-success)' : 'var(--nb-danger)' }}; color: var(--nb-paper); padding: 4px 10px; border: var(--nb-border); font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">
                                                        {{ ucfirst($mitra->status) }}
                                                    </span>
                                                </td> 
                                                <td style="border: var(--nb-border);"> 
                                                    <button class="nb-btn btn-warning mb-2 mb-md-0 mr-md-2" data-toggle="modal" data-target="#editMitraModal{{ $mitra->id }}">Edit</button> 
                                                    <form action="{{ route('pengguna.suspendm', $mitra->id) }}" method="POST" style="display:inline;"> 
                                                        @csrf 
                                                        <button type="submit" class="nb-btn btn-danger">Suspend</button> 
                                                    </form> 
                                                </td> 
                                            </tr> 
                                        @endforeach 
                                    </tbody> 
                                </table> 
                            </div> 
                            <div class="mt-4 d-flex justify-content-center">
                                {{ $mitras->appends(['users_page' => request('users_page')])->links('pagination::bootstrap-5') }}
                            </div>
                        </div> 
                    </div> 
                </div> 
            </div> 
        </section> 
    </div> 

    <!-- Modal Edit User -->
    @foreach($users as $user) 
        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border: var(--nb-border); box-shadow: var(--nb-shadow-lg); border-radius: 8px;">
                    <div class="modal-header" style="background: transparent; border-bottom: var(--nb-border); border-radius: 8px 8px 0 0;">
                        <h5 class="modal-title" id="editUserModalLabel" style="font-family: var(--nb-font-display); font-size: 1.5rem; margin: 0;">Edit Pengguna</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 1; font-weight: bold; font-family: var(--nb-font-display);">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('pengguna.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body" style="background: var(--nb-paper); padding: 25px;">
                            <div class="form-group">
                                <label for="name" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Nama</label>
                                <input type="text" class="form-control nb-input" id="name" name="name" value="{{ $user->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Email</label>
                                <input type="email" class="form-control nb-input" id="email" name="email" value="{{ $user->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="status" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Status</label>
                                <select class="form-control nb-input" id="status" name="status" required>
                                    <option value="aktif" {{ $user->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="suspended" {{ $user->status == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cv" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">CV</label>
                                <input type="file" class="form-control nb-input" id="cv" name="cv">
                            </div>
                            <div class="form-group">
                                <label for="description" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Deskripsi</label>
                                <textarea class="form-control nb-input" id="description" name="description" rows="3">{{ $user->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="portfolio" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Portofolio</label>
                                <input type="file" class="form-control nb-input" id="portfolio" name="portfolio">
                            </div>
                        </div>
                        <div class="modal-footer" style="border-top: var(--nb-border); background: var(--nb-surface);">
                            <button type="button" class="nb-btn btn-white" data-dismiss="modal">Close</button>
                            <button type="submit" class="nb-btn btn-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Edit Mitra -->
    @foreach($mitras as $mitra) 
        <div class="modal fade" id="editMitraModal{{ $mitra->id }}" tabindex="-1" role="dialog" aria-labelledby="editMitraModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border: var(--nb-border); box-shadow: var(--nb-shadow-lg); border-radius: 8px;">
                    <div class="modal-header" style="background: transparent; border-bottom: var(--nb-border); border-radius: 8px 8px 0 0;">
                        <h5 class="modal-title" id="editMitraModalLabel" style="font-family: var(--nb-font-display); font-size: 1.5rem; margin: 0;">Edit Mitra</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 1; font-weight: bold; font-family: var(--nb-font-display);">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('pengguna.updateMitra', $mitra->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body" style="background: var(--nb-paper); padding: 25px;">
                            <div class="form-group">
                                <label for="name" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Nama</label>
                                <input type="text" class="form-control nb-input" id="name" name="name" value="{{ $mitra->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Email</label>
                                <input type="email" class="form-control nb-input" id="email" name="email" value="{{ $mitra->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="status" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Status</label>
                                <select class="form-control nb-input" id="status" name="status" required>
                                    <option value="aktif" {{ $mitra->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="suspended" {{ $mitra->status == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="role" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Role</label>
                                <select class="form-control nb-input" id="role" name="role" required>
                                    <option value="basic" {{ $mitra->role == 'basic' ? 'selected' : '' }}>Basic</option>
                                    <option value="premium" {{ $mitra->role == 'premium' ? 'selected' : '' }}>Premium</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer" style="border-top: var(--nb-border); background: var(--nb-surface);">
                            <button type="button" class="nb-btn btn-white" data-dismiss="modal">Close</button>
                            <button type="submit" class="nb-btn btn-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection  

