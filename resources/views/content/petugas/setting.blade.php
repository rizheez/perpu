@extends('layouts.master')
@section('title', 'DATA PETUGAS')

@push('css')
    <style>
        table td {
            text-align: center;
        }

        .actions {
            display: flex;
            justify-content: space-between;

        }

        .btn2 {
            /* padding: 0.6rem 1rem; */
            font-size: 13px;
            opacity: 1;
            border-radius: 3px;
        }
    </style>


    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    {{-- <h4 class="page-title">Data Buku</h4> --}}
                    <ul class="breadcrumbs d-flex ml-auto">
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
                            <p>Account Setting</p>
                        </li>
                    </ul>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Akun</div>
                    </div>
                    <form id="form-akun" action="{{ route('petugas.edits', $data->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if (session('success'))
                            <p class="alert alert-success text-success">
                                {{ session('success') }}
                                <i class="bi bi-check-circle-fill"></i>
                            </p>
                        @endif
                        @if (session('error'))
                            <p class="alert alert-danger text-danger">
                                {{ session('error') }}
                                <i class="bi bi-x-circle-fill"></i>
                            </p>
                        @endif
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Username" value="{{ $data->username }}">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="********">
                            </div>
                            <div class="form-group d-flex flex-column">
                                <label class="fw-bold" for="profile">Upload File Profile Untuk Mengubah Gambar Profile<p>
                                        (Abaikan
                                        jika
                                        tidak ingin mengubah
                                        gambar profile)</p></label>
                                <p id="preview-text" class="mt-2" style="display:none">Preview Profile</p>
                                <img id="preview" src="" alt="" style="max-width: 150px">
                                {{-- <input type="file" class="form-control-file" id="gambar" name="gambar"> --}}
                                <input type="file" name="profile" id="profile" class="form-control-file mt-3"
                                    onchange="previewImage(event)">
                            </div>
                        </div>
                        <div class="card-action d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
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
