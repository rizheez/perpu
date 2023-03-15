@extends('layouts.master')
@section('title', 'Form Tambah Buku')

@push('css')
@endpush

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Forms</h4>
                    <ul class="breadcrumbs ml-auto">
                        <li class="nav-home">
                            <a href="/">
                                <i class="flaticon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <p>Master Data</p>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('buku.index') }}" style="font-size:14px">Buku</a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <p>Tambah Data</p>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Tambah Data Buku</div>
                    </div>
                    <form id="form-buku" action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" id="judul" placeholder="Masukkan Judul"
                                    name="judul">
                            </div>
                            <div class="form-group">
                                <label for="penulis_id">Penulis</label>
                                <select class="form-control" id="penulis" name="penulis_id">
                                    @foreach ($penulis as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group pt-2">
                                <label for="kategori_id">Kategori</label>
                                <select class="form-control" id="kategori" name="kategori_id">
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="penerbit">Penerbit</label>
                                <input type="text" class="form-control" id="penerbit" placeholder="Masukkan penerbit"
                                    name="penerbit">
                            </div>
                            <div class="form-group">
                                <label for="tahun_terbit">Tahun Terbit</label>
                                <input type="text" min="2000" max="2022" class="form-control" id="tahun_terbit"
                                    name="tahun_terbit" placeholder="Tahun">
                            </div>
                            <div class="form-group">
                                <label for="Stok">Stok</label>
                                <input type="number" min="0" max="500" class="form-control" id="Stok"
                                    name="stok" placeholder="Stok">
                            </div>
                            <div class="form-group">
                                <label for="gambar">Upload File Gambar</label>
                                <p id="preview-text" class="mt-2" style="display:none">Preview Gambar</p>
                                <img id="preview" src="" alt="" style="max-width: 150px">
                                <input type="file" class="form-control-file mt-3" id="gambar" name="gambar"
                                    onchange="previewImage(event)">
                            </div>
                        </div>
                        <div class="card-action d-flex justify-content-end">
                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview');
                output.src = reader.result;
                let previewText = document.getElementById('preview-text');
                previewText.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <script>
        document.querySelector('#form-buku').addEventListener('submit', (e) => {
            e.preventDefault();

            // Get the form data
            const formData = new FormData(e.target);

            // Validasi apakah semua field diisi
            if (!formData.get('judul') || !formData.get('tahun_terbit') || !formData.get('stok') || !formData.get(
                    'penerbit')) {
                swal({
                    title: 'Error!',
                    text: 'Harap isi semua field',
                    icon: 'error',
                    button: {
                        className: 'btn btn-danger'
                    }
                });
                return false;
            }

            // Submit form jika data sudah diisi
            swal({
                icon: 'success',
                title: 'Success',
                text: 'Data berhasil disimpan',
                button: {
                    className: 'btn btn-primary'
                }
            }).then((result) => {
                if (result == true) {
                    e.target.submit();
                }
            })
        });
    </script>
@endpush
