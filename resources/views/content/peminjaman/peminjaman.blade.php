@extends('layouts.master')
@section('title', 'DATA PEMINJAMAN')

@push('css')
    <style>
        table td {
            text-align: center;
        }

        .actions {
            display: flex;
            justify-content: space-between;

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
                            <p>Master Data</p>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <p>Buku</p>
                        </li>
                    </ul>
                </div>
                <div class="row">


                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Data Buku</h4>
                                    <a href="{{ route('pinjam.create') }}" class="btn btn-primary btn-round ml-auto">
                                        <i class="fa fa-plus"></i>
                                        Add Row
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Modal -->
                                {{-- <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header no-bd">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold">
                                                        New</span>
                                                    <span class="fw-light">
                                                        Row
                                                    </span>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="small">Create a new row using this form, make sure you fill them
                                                    all</p>
                                                <form>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label>Name</label>
                                                                <input id="addName" type="text" class="form-control"
                                                                    placeholder="fill name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 pr-0">
                                                            <div class="form-group form-group-default">
                                                                <label>Position</label>
                                                                <input id="addPosition" type="text" class="form-control"
                                                                    placeholder="fill position">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Office</label>
                                                                <input id="addOffice" type="text" class="form-control"
                                                                    placeholder="fill office">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer no-bd">
                                                <button type="button" id="addRowButton"
                                                    class="btn btn-primary">Add</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="table-responsive">
                                    <table id="table-buku" class="display table table-striped table-hover">
                                        <thead class="text-uppercase">
                                            <tr class="text-center">
                                                <th>NO</th>
                                                <th>ID</th>
                                                <th>Judul</th>
                                                <th>Penulis</th>
                                                <th>Kategori</th>
                                                <th>Penerbit</th>
                                                <th>Tahun Terbit</th>
                                                <th>Stok</th>
                                                <th>Gambar</th>
                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="text-uppercase">
                                            <tr class="text-center">
                                                <th>NO</th>
                                                <th>ID</th>
                                                <th>Judul</th>
                                                <th>Penulis</th>
                                                <th>Kategori</th>
                                                <th>Penerbit</th>
                                                <th>Tahun Terbit</th>
                                                <th>Stok</th>
                                                <th>Gambar</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>

                                    </table>
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
            const table = $('#table-buku').DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                order: [
                    [1, 'asc']
                ],
                ajax: "{{ route('buku.index') }}",
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
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'penulis.nama',
                        name: 'penulis.nama'
                    },
                    {
                        data: 'kategori.nama',
                        name: 'kategori.nama'
                    },
                    {
                        data: 'penerbit',
                        name: 'penerbit',
                        orderable: false
                    },
                    {
                        data: 'tahun_terbit',
                        name: 'tahun_terbit'
                    },
                    {
                        data: 'stok',
                        name: 'stok',
                        orderable: false
                    },
                    {
                        data: 'gambar',
                        name: 'gambar',
                        render: function(data, type, full, meta) {
                            return '<img class="rounded mx-auto d-block" src="{{ asset('storage/') }}/' +
                                data + '" width="50">';
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

            $('#table-buku').on('click', '.delete', function(event) {
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
                            url: "/buku/" + id,
                            type: "DELETE",
                            dataType: 'json',
                            success: function(data) {
                                swal({
                                    title: 'Berhasil!',
                                    text: 'Data Berhasil dihapus.',
                                    icon: 'success'
                                }).then(() => {
                                    table.ajax.reload();

                                })
                            },
                            error: function(data) {
                                swal({
                                    title: 'Oops!',
                                    text: 'Terjadi kesalahan saat menghapus data.',
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
