@extends('layouts.admin.main') 
@section('title', 'Manajemen Konten') 
@section('content') 
    <div class="main-content"> 
        <section class="section"> 
            <div class="section-header" style="background: var(--nb-surface); border: var(--nb-border); box-shadow: 4px 4px 0px var(--nb-ink); border-radius: 0;"> 
                <h1 style="font-family: var(--nb-font-display);">Manajemen Konten</h1> 
                <div class="section-header-breadcrumb"> 
                    <div class="breadcrumb-item active"><a href="#" style="font-family: var(--nb-font-ui); font-weight: bold; color: var(--nb-ink);">Manajemen Konten</a></div> 
                </div> 
            </div> 

            <!-- Daftar Konten -->
            <div class="row"> 
                <div class="col-12"> 
                    <div class="card nb-card" style="background: var(--nb-paper);"> 
                        <div class="card-header" style="border-bottom: var(--nb-border);"> 
                            <h4 style="font-family: var(--nb-font-display); font-size: 1.5rem;">Daftar Konten</h4> 
                        </div> 
                        <div class="card-body"> 
                            <div class="row"> 
                            @foreach($contents as $content) 
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-4"> 
                                    <div class="card nb-card" style="background: var(--nb-soft); height: 100%;"> 
                                        <div class="card-body d-flex flex-column"> 
                                            <h5 class="card-title" style="font-family: var(--nb-font-display); font-size: 1.25rem;">{{ $content->title }}</h5> 
                                            <p class="card-text flex-grow-1" style="font-weight: 500;">{{ $content->body }}</p> 
                                            <button class="nb-btn btn-white mb-3" style="width: fit-content;">{{ $content->button_name }}</button>
                                            <p class="card-text mb-4"><small class="text-muted" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Publikasi: {{ $content->created_at->format('Y-m-d') }}</small></p> 
                                            <div class="d-flex justify-content-between mt-auto"> 
                                                <button class="nb-btn btn-warning" data-toggle="modal" data-target="#editContentModal" data-id="{{ $content->id }}" data-title="{{ $content->title }}" data-button-name="{{ $content->button_name }}" data-body="{{ $content->body }}">Edit</button> 
                                                <form action="{{ route('konten.destroy', $content->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus konten ini?')">
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
                </div> 
            </div> 

            <!-- Tambah Konten Baru -->
            <div class="row"> 
                <div class="col-12"> 
                    <div class="card nb-card" style="background: var(--nb-paper);"> 
                        <div class="card-header" style="border-bottom: var(--nb-border);"> 
                            <h4 style="font-family: var(--nb-font-display); font-size: 1.5rem;">Tambah Konten Baru</h4> 
                        </div> 
                        <div class="card-body" style="padding: 30px;"> 
                            <form action="{{ route('konten.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="contentTitle" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Judul Konten</label>
                                    <input type="text" class="form-control nb-input" name="title" id="contentTitle" placeholder="Masukkan judul konten" required>
                                </div>
                                <div class="form-group">
                                    <label for="buttonName" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Nama Button</label>
                                    <input type="text" class="form-control nb-input" name="button_name" id="buttonName" placeholder="Masukkan nama Button" required>
                                </div>
                                <div class="form-group">
                                    <label for="contentBody" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Isi Konten</label>
                                    <textarea class="form-control nb-input" name="body" id="contentBody" rows="5" placeholder="Masukkan isi konten" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="contentImage" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Unggah Gambar Terkait</label>
                                    <input type="file" class="form-control-file nb-input" name="image" id="contentImage">
                                </div>
                                <button type="submit" class="nb-btn btn-primary" style="font-size: 1.1rem; padding: 12px 24px;">Simpan Konten</button>
                            </form>
                        </div> 
                    </div> 
                </div> 
            </div> 
        </section> 
    </div> 

    <!-- Modal Edit Konten -->
    <div class="modal fade" id="editContentModal" tabindex="-1" role="dialog" aria-labelledby="editContentModalLabel" aria-hidden="true"> 
        <div class="modal-dialog" role="document"> 
            <div class="modal-content" style="border: var(--nb-border); box-shadow: 8px 8px 0px var(--nb-ink); border-radius: 0;"> 
                <div class="modal-header" style="background: var(--nb-primary); border-bottom: var(--nb-border); border-radius: 0;"> 
                    <h5 class="modal-title" id="editContentModalLabel" style="font-family: var(--nb-font-display); font-size: 1.5rem; margin: 0;">Edit Konten</h5> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 1; font-weight: bold; font-family: var(--nb-font-display);"> 
                        <span aria-hidden="true">&times;</span> 
                    </button> 
                </div> 
                <div class="modal-body" style="background: var(--nb-paper); padding: 25px;"> 
                    <form id="editContentForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="editTitle" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Judul Konten</label>
                            <input type="text" class="form-control nb-input" name="title" id="editTitle" required>
                        </div>
                        <div class="form-group">
                            <label for="editButtonName" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Nama Button</label>
                            <input type="text" class="form-control nb-input" name="button_name" id="editButtonName" required>
                        </div>
                        <div class="form-group">
                            <label for="editBody" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Isi Konten</label>
                            <textarea class="form-control nb-input" name="body" id="editBody" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editImage" style="font-family: var(--nb-font-ui); font-weight: bold; text-transform: uppercase;">Unggah Gambar Terkait (Opsional)</label>
                            <input type="file" class="form-control-file nb-input" name="image" id="editImage">
                        </div>
                </div> 
                <div class="modal-footer" style="border-top: var(--nb-border); background: var(--nb-surface);"> 
                    <button type="button" class="nb-btn btn-white" data-dismiss="modal">Tutup</button> 
                    <button type="submit" form="editContentForm" class="nb-btn btn-primary">Simpan Perubahan</button>
                </div> 
                </form>
            </div> 
        </div> 
    </div> 
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#editContentModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var title = button.data('title');
                var buttonName = button.data('button-name');
                var body = button.data('body');

                var modal = $(this);
                modal.find('.modal-body #editTitle').val(title);
                modal.find('.modal-body #editButtonName').val(buttonName);
                modal.find('.modal-body #editBody').val(body);
                modal.find('form').attr('action', '/admin/konten/' + id);
            });
        });
    </script>
@endsection 
