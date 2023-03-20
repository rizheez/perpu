@extends('layouts.master')
@section('title', 'EDIT DATA')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner ">
                <div class="page-header">
                    <h4 class="page-title">Forms</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="{{ route('dashboard') }}">
                                <i class="flaticon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <span>Informasi</span>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <span>Penulis</span>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <span>Edit Data</span>
                        </li>
                    </ul>
                </div>
                <div class="row justify-content-center mt-5 pt-5">
                    <div class="col-md-6 ">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Edit Data Penulis</div>
                            </div>
                            <form id="form_penulis" action="{{ route('penulis.edit', $penulis->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Masukkan Nama" value="{{ $penulis->nama }}">

                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Masukkan Email" value="{{ $penulis->email }}">
                                    </div>
                                    <div class="form-group d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary mr-2 btn-berhasil"
                                            data-id="{{ $penulis->id }}" data-name="{{ $penulis->nama }}">Submit</button>
                                        <a href="{{ route('penulis.index') }}" class="btn btn-danger">Cancel</a>
                                    </div>

                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    @endsection

    @push('script')
        <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

        <script>
            $(document).on('click', '.btn-berhasil', function() {
                event.preventDefault();
                let id = $(this).data('id');
                let name = $(this).data('name');
                $.ajax({
                    url: "{{ route('penulis.edit', $penulis->id) }}",
                    type: 'POST',
                    data: $('#form_penulis').serialize(),
                    success: function(response) {
                        swal({
                            title: 'Berhasil!',
                            text: 'Data Berhasil diubah.',
                            icon: 'success'
                        }).then(() => {
                            window.location.href = "{{ route('penulis.index') }}"

                        })
                    },
                    error: function(xhr) {
                        swal({
                            title: 'Oops!',
                            text: 'Terjadi kesalahan saat mengubah data.',
                            icon: 'error'
                        });
                    }
                });

            });
        </script>
    @endpush
