@extends('layouts.master')
@section('title', 'Form Tambah Buku')

@push('css')
@endpush

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    {{-- <h4 class="page-title">Forms</h4> --}}
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
                            <p>Peminjaman</p>
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
                        <div class="page-title text-uppercase ml-2">Tambah Data Buku</div>
                    </div>
                    <form id="form-peminjaman" action="{{ route('peminjaman.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="buku_id">Buku</label>
                                <select class="form-control selectpicker" data-live-search="true" id="penulis"
                                    name="buku_id">
                                    @foreach ($buku as $id => $judul)
                                        <option data-tokens="{{ $id }}" value="{{ $id }}">
                                            {{ $judul }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group pt-2">
                                <label for="anggota_id">Anggota</label>
                                <select class="form-control selectpicker" data-live-search="true" id="anggota"
                                    name="anggota_id">
                                    @foreach ($anggota as $id => $nama)
                                        <option data-tokens="{{ $id }}" value="{{ $id }}">
                                            {{ $nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                                <input type="date" class="form-control" id="tanggal_peminjaman"
                                    placeholder="Masukkan tanggal peminjaman" name="tanggal_peminjaman">
                            </div>
                            {{-- <div class="form-group">
                                <label for="tanggal_kembali">Tanggal Pengembalian</label>
                                <input type="date" class="form-control" id="tanggal_kembali"
                                    placeholder="Masukkan tanggal kembali" name="tanggal_kembali">
                            </div> --}}

                            <input type="hidden" name="petugas_id" value="{{ Auth::guard('petugas')->user()->id }}">

                        </div>
                        <div class="card-action d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-danger">Cancel</a>
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
        document.querySelector('#form-peminjaman').addEventListener('submit', (e) => {
            e.preventDefault();

            // Get the form data
            const formData = new FormData(e.target);

            // Validasi apakah semua field diisi
            if (!formData.get('buku_id')) {
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
