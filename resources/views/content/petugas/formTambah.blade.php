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
                    <form id="form-petugas" action="{{ route('petugas.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" placeholder="Masukkan nama"
                                    name="nama">
                            </div>
                            <div class="form-group">
                                <label for="alamat">alamat</label>
                                <input type="text" class="form-control" id="alamat" placeholder="Masukkan alamat"
                                    name="alamat">
                            </div>
                            <div class="form-group pt-2">
                                <label for="telepon">telepon</label>
                                <input type="text" class="form-control" id="telepon" placeholder="Masukkan telepon"
                                    name="telepon">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Masukkan email"
                                    name="email">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="password">
                            </div>
                            <div class="form-group">
                                <label for="profile">Upload File profile</label>
                                <p id="preview-text" class="mt-2" style="display:none">Preview profile</p>
                                <img id="preview" src="" alt="" style="max-width: 150px">
                                <input type="file" class="form-control-file mt-3" id="profile" name="profile"
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
        document.querySelector('#form-petugas').addEventListener('submit', (e) => {
            e.preventDefault();

            // Get the form data
            const formData = new FormData(e.target);

            // Validasi apakah semua field diisi
            if (!formData.get('nama') || !formData.get('email') || !formData.get('alamat') || !formData.get(
                    'telepon')) {
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
