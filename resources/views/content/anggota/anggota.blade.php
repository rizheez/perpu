@extends('layouts.master')
@section('title', 'DATA ANGGOTA')

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
                            <p>Anggota</p>
                        </li>
                    </ul>
                </div>
                <div class="row">


                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="page-title text-uppercase ml-2">Data Anggota</h4>
                                    <a href="{{ route('anggota.create') }}" class="btn btn-primary ml-auto">
                                        <i class="fa fa-plus"></i>
                                        Tambah Data
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="table-anggota" class="display table table-striped table-hover">
                                        <thead class="text-uppercase">
                                            <tr class="text-center">
                                                <th>NO</th>
                                                <th>ID</th>
                                                <th>nama</th>
                                                <th>alamat</th>
                                                <th>no telepon</th>
                                                <th>email</th>
                                                <th>profile</th>

                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="text-uppercase">
                                            <tr class="text-center">
                                                <th>NO</th>
                                                <th>ID</th>
                                                <th>nama</th>
                                                <th>alamat</th>
                                                <th>no telepon</th>
                                                <th>email</th>
                                                <th>profile</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="page-title ml-2">{{ __('Download Laporan Anggota') }}</h3>

                                <div class="card-body">
                                    <form method="POST" action="{{ route('laporan.anggota') }}">
                                        @csrf
                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                        <div class="form-group row">
                                            <label for="bulan"
                                                class="col-md-4 col-form-label text-md-right">{{ __('Bulan') }}</label>

                                            <div class="col-md-6">
                                                <select id="bulan" name="bulan"
                                                    class="form-control @error('bulan') is-invalid @enderror">
                                                    <option value="" selected disabled>-- Pilih Bulan --</option>
                                                    <option value="01">Januari</option>
                                                    <option value="02">Februari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tahun"
                                                class="col-md-4 col-form-label text-md-right">{{ __('Tahun') }}</label>

                                            <div class="col-md-6">
                                                <select id="tahun" name="tahun"
                                                    class="form-control @error('tahun') is-invalid @enderror">
                                                    <option value="" selected disabled>-- Pilih Tahun --</option>
                                                    @for ($i = 2023; $i <= 2025; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>

                                                @error('tahun')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Download Laporan') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            const table = $('#table-anggota').DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                order: [
                    [1, 'asc']
                ],
                ajax: "{{ route('anggota.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false

                    },
                    {
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'telepon',
                        name: 'telepon'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        orderable: false
                    },
                    {
                        data: 'profile',
                        name: 'profile',
                        render: function(data, type, full, meta) {
                            if (data === null) {
                                data = 'Belum Diupload';
                            } else {
                                data =
                                    '<img class="rounded mx-auto d-block" src="{{ asset('storage/anggota/profile') }}/' +
                                    data + '" width="50">';
                            }
                            return data;

                        },
                        orderable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    },
                ]
            });


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#table-anggota').on('click', '.delete', function(event) {
                event.preventDefault();
                var id = $(this).data('id');
                swal({
                    title: 'Apakah Anda Yakin?',
                    text: 'Data akan dihapus secara permanen!',
                    icon: 'warning',
                    buttons: {
                        confirm: {
                            text: 'Iya!, Hapus Data!',
                            className: 'btn btn-primary'
                        },
                        cancel: {
                            visible: true,
                            text: 'Tidak!',
                            className: 'btn btn-danger'
                        }
                    }
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "/admin/anggota/" + id,
                            type: "DELETE",
                            dataType: 'json',
                            success: function(data) {
                                swal({
                                    title: 'Berhasil!',
                                    text: data.message,
                                    icon: 'success'
                                }).then(() => {
                                    table.ajax.reload();

                                })
                            },
                            error: function(data) {
                                swal({
                                    title: 'Oops!',
                                    text: data.message,
                                    icon: 'error'
                                });
                            }
                        });
                    } else {
                        swal('Data Aman!')
                    }
                });
            })
        });
    </script>
@endpush
