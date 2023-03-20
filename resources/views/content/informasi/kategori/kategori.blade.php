@extends('layouts.master')
@section('title', 'DATA PENULIS')
@push('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    {{-- <h4 class="page-title text-uppercase ml-2">Data Penulis</h4> --}}

                    <ul class="breadcrumbs d-flex ml-auto">
                        <li class="nav-home">
                            <a href="{{ route('dashboard') }}">
                                <i class="flaticon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <span>Master Data</span>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <span>Kategori</span>
                        </li>
                    </ul>

                </div>

                <div class="row">


                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="page-title text-uppercase ml-2">Data Kategori</h4>
                                    <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#addModal">
                                        <i class="fa fa-plus"></i>
                                        Tambah Data
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Modal -->
                                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                <p class="small">Masukkan Data Kategori</p>
                                                <form id="add-form" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label for="nama">Nama Kategori</label>
                                                                <input id="nama" type="text" name="nama"
                                                                    class="form-control" placeholder="Isi Nama Kategori">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer no-bd">
                                                        <button type="submit" id="addRowButton"
                                                            class="btn btn-primary btn-berhasil" id="alertBtn">Add</button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table id="kategori-table" class="display table table-striped table-hover">
                                        <thead class="text-uppercase font-weight-bold">
                                            <tr>
                                                <th>No</th>
                                                <th>ID Kategori</th>
                                                <th>Kategori</th>

                                                <th style="width: 10%">action</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="text-uppercase font-weight-bold">
                                            <tr>
                                                <th>No</th>
                                                <th>ID Kategori</th>
                                                <th>Kategori</th>
                                                <th>action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            {{-- @foreach ($kategori as $k)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $k->id }}</td>
                                                    <td>{{ $k->nama }}</td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a href="{{ route('kategori.update', $k->id) }}"
                                                                class="btn btn-link btn-primary btn-lg">

                                                                <i class="fa fa-edit"></i>
                                                            </a>

                                                            <form method="POST"
                                                                action="{{ route('kategori.hapus', $k->id) }}">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="button" data-id="{{ $k->id }}"
                                                                    data-name="{{ $k->nama }}"
                                                                    class="btn btn-link btn-danger btn-danger2"
                                                                    id="btnAlert"><i class="fa fa-times"></i></button>
                                                            </form>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                            <!-- Modal -->
                                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                                aria-hidden="true">
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
                                                            <p class="small">Edit Data Penulis</p>
                                                            <form id="edit-form">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="id" class="id-field"
                                                                    value="">
                                                                <div class="form-group">
                                                                    <label for="nama"
                                                                        class="col-form-label">Nama:</label>
                                                                    <input type="text"
                                                                        class="form-control form-group-default"
                                                                        id="edit-nama" name="nama" value=""
                                                                        required>
                                                                </div>
                                                                <div class="modal-footer no-bd">
                                                                    <button type="submit" id="editKategoriButton"
                                                                        class="btn btn-primary btn-berhasil">Add</button>
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Modal Edit -->
                                            {{-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                                aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- form untuk mengedit data -->
                                                            <form id="edit-form" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="id" class="id-field"
                                                                        value="">
                                                                    <div class="form-group">
                                                                        <label for="nama"
                                                                            class="col-form-label">Nama:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="edit-kategori" name="nama"
                                                                            value="" required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="button"
                                                                        class="btn btn-primary btn-simpan"
                                                                        id="editKategoriButton">Save
                                                                        changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </tbody>
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

{{-- @push('script')
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $(document).on('click', '.btn-berhasil', function() {
            event.preventDefault();
            $.ajax({
                url: "{{ route('kategori.tambah') }}",
                type: 'POST',
                data: $('#form_kategori').serialize(),
                success: function(response) {
                    swal({
                        title: 'Berhasil!',
                        text: 'Data Berhasil ditambahkan.',
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    swal({
                        title: 'Oops!',
                        text: 'Terjadi kesalahan saat menambah data.',
                        icon: 'error'
                    });
                }
            });
            // swal("Good job!", "You clicked the button!", {

            //     icon: "success",
            //     buttons: {
            //         confirm: {
            //             className: 'btn btn-success'
            //         }
            //     },

            // })
        });
    </script>

    <script>
        $(document).on('click', '.btn-danger2', function() {
            event.preventDefault();
            let id = $(this).data('id');
            let name = $(this).data('name');
            swal({
                title: 'Apakah Anda Yakin?',
                text: 'Data ' + name + ' akan dihapus secara permanen!',
                type: 'warning',
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
                        url: '{{ url('/kategori') }}/' + id,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            swal({
                                title: 'Berhasil!',
                                text: 'Data ' + name + ' telah dihapus.',
                                icon: 'success'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            swal({
                                title: 'Oops!',
                                text: 'Terjadi kesalahan saat menghapus data.',
                                icon: 'error'
                            });
                        }
                    });
                } else {
                    swal("Data Aman!");
                }
            });
        })
    </script>



    <script>
        $(document).ready(function() {
            // Add Row
            $('#add-row').DataTable({
                "pageLength": 5,
            });



            var action =
                '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger btn-danger2" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

            var counter = 1;



            $('#addRowButton').click(function() {
                // $('#add-row').dataTable().fnAddData([



                //     // counter,
                //     // $("#nama").val(),
                //     // action
                // ]);
                // counter++;
                $('#addRowModal').modal('hide');

            });
        });
    </script>
@endpush --}}


@push('script')
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            // Initialize DataTable
            const table = $('#kategori-table').DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: "{{ route('kategori.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return '<a href="javascript:void(0)" class="btn btn-link btn-info edit" data-toggle="modal" data-target="#editModal" data-id="' +
                                row.id + '"><i class="fa fa-edit"></i></a> ' +
                                '<a href="javascript:void(0)" class="btn btn btn-link btn-danger delete" data-id="' +
                                row.id + '"><i class="fa fa-times"></i></a>';
                        }
                    }
                ]
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            // Handle Tambah Penulis
            $('#add-form').on('submit', function(event) {
                event.preventDefault();
                let name = $('#nama').val();

                if (!name) {
                    swal({
                        title: "Error",
                        text: "Field tidak boleh kosong!",
                        icon: "error",
                    });
                    return false;
                }
                $.ajax({
                    url: "/admin/kategori",
                    type: "POST",
                    data: $('#add-form').serialize(),
                    dataType: 'json',
                    success: function(data) {
                        $('#add-form')[0].reset();
                        $('#addModal').modal('hide');
                        swal({
                            title: 'Berhasil!',
                            text: 'Data Berhasil ditambahkan.',
                            icon: 'success',
                            allowEnterKey: true,
                        }).then(() => {
                            table.ajax.reload();

                        })
                    },
                    error: function(data) {
                        swal({
                            title: 'Oops!',
                            text: 'Terjadi kesalahan saat menambah data.',
                            icon: 'error'
                        });
                    }
                });
            });

            $('#kategori-table tbody').on('click', '.delete', function(event) {
                event.preventDefault();
                var id = $(this).data('id');
                swal({
                    title: 'Apakah Anda Yakin?',
                    text: 'Data akan dihapus secara permanen!',
                    type: 'warning',
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
                            url: "/admin/kategori/" + id,
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
                                    text: 'Data Ini Berelasi Ke Data Buku, Data Tidak Bisa Dihapus!',
                                    icon: 'error'
                                });
                            }
                        });
                    } else {
                        swal('Data Aman!')
                    }


                });
            })



            // Handle Edit Button Click
            $('#kategori-table tbody').on('click', '.edit', function(event) {
                var id = $(this).data('id');
                event.preventDefault();
                console.log(id)
                $.ajax({
                    url: '/admin/kategori/' + id + '/edit',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // memasukkan data penulis ke dalam modal
                        $('#editModal').modal('show');
                        $('#editModal').attr('data-id', id);
                        $('#edit-nama').val(data.result.nama);
                    }
                });
            });

            $('#edit-form').on('submit', function(event) {
                var id = $('#editModal').data('id');
                event.preventDefault();
                console.log(id)
                $.ajax({
                    url: '/admin/kategori/' + id,
                    type: "PUT",
                    data: $('#edit-form').serialize(),
                    dataType: 'json',
                    success: function(data) {
                        $('#edit-form')[0].reset();
                        $('#editModal').modal('hide');
                        swal({
                            title: 'Berhasil!',
                            text: 'Data Berhasil ditambahkan.',
                            icon: 'success',
                            allowEnterKey: true,
                            closeOnEsc: true,
                        }).then(() => {
                            location.reload();

                        })
                    },
                    error: function(data) {
                        swal({
                            title: 'Oops!',
                            text: 'Terjadi kesalahan saat mengedit data.',
                            icon: 'error'
                        });
                    }
                });
            })

        });
    </script>
@endpush
