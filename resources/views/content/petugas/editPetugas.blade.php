@extends('layouts.master')
@section('title', 'Edit Buku')


@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">

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
                            <p>Petugas</p>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <p>Edit</p>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="text-upercase ml-2 page-title">Edit Data Petugas</div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('petugas.edit', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" placeholder="Masukkan nama"
                                    name="nama" value="{{ $data->nama }}">
                            </div>
                            <div class="form-group">
                                <label for="alamat">alamat</label>
                                <input type="text" class="form-control" id="alamat" placeholder="Masukkan alamat"
                                    name="alamat" value="{{ $data->alamat }}">
                            </div>
                            <div class="form-group pt-2">
                                <label for="telepon">telepon</label>
                                <input type="text" class="form-control" id="telepon" placeholder="Masukkan telepon"
                                    name="telepon" value="{{ $data->telepon }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Masukkan email"
                                    name="email" value="{{ $data->email }}">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Username" value="{{ $data->username }}">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="********">
                                <span class="font-italic"><strong>Tidak perlu mengisi field ini jika tidak ingin mengubah
                                        password</strong> </span>
                            </div>
                            <div class="form-group  d-flex flex-column">
                                <label class="fw-bold" for="profile">Upload File Profile Untuk Mengubah Gambar Profile
                                    <p>
                                        (Abaikan
                                        jika
                                        tidak ingin mengubah
                                        gambar profile)</p>
                                </label>
                                <p id="preview-text" class="mt-2" style="display:none">Preview Profile</p>
                                <img id="preview" src="" alt="" style="max-width: 150px">
                                {{-- <input type="file" class="form-control-file" id="gambar" name="gambar"> --}}
                                <input type="file" name="profile" id="profile" class="form-control-file mt-3"
                                    onchange="previewImage(event)">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="role" class="form-control" id="role" name="role" placeholder="role"
                                    value="{{ $data->role }}">
                            </div>
                        </div>
                        <div class="card-action d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ route('petugas.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
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
@endpush
