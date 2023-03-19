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
                            <span>Penulis</span>
                        </li>
                    </ul>

                </div>

                <div class="row">


                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="page-title text-uppercase ml-2">Data Penulis</h4>
                                    <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#addModal">
                                        <i class="fa fa-plus"></i>
                                        Tambah Data
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!--Tambah data Modal -->
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
                                                <p class="small">Masukkan Data Penulis</p>
                                                <form id='add-form' method="post" action="{{ route('penulis.store') }}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label for="nama">Nama</label>
                                                                <input id="nama" type="text" name="nama"
                                                                    class="form-control" placeholder="Isi Nama">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label for="email">Email</label>
                                                                <input id="email" type="email" name="email"
                                                                    class="form-control" placeholder="Isi Email">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer no-bd">
                                                        <button type="submit" id="addRowButton"
                                                            class="btn btn-primary">Tambah</button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="table-responsive">
                                <table id="penulis-table" class="display table table-striped table-hover">
                                    <thead class="text-uppercase font-weight-bold">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="text-uppercase font-weight-bold">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    {{-- <tbody>
                                            @foreach ($penulis as $p)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $p->nama }}</td>
                                                    <td>{{ $p->email }}</td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <button data-toggle="modal" data-target="#editRowModal"
                                                                href="{{ route('penulis.edit', $p->id) }}"
                                                                data-id="{{ $p->id }}"
                                                                class="btn btn-link btn-primary btn-lg close btn-edit">
                                                                <i class="fa fa-edit"></i>
                                                            </button>

                                                            <div class="modal fade" id="editRowModal" tabindex="-1"
                                                                role="dialog" aria-hidden="true">
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
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p class="small">Masukkan Data Penulis</p>
                                                                            <form id='edit_penulis' method="post"
                                                                                action="{{ route('penulis.edit', $p->id) }}">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div
                                                                                            class="form-group form-group-default">
                                                                                            <label
                                                                                                for="nama">Nama</label>
                                                                                            <input id="nama"
                                                                                                type="text"
                                                                                                name="nama"
                                                                                                class="form-control"
                                                                                                placeholder="Isi Nama"
                                                                                                
                                                                                                value="{{ $p->nama }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-12">
                                                                                        <div
                                                                                            class="form-group form-group-default">
                                                                                            <label
                                                                                                for="email">Email</label>
                                                                                            <input id="email"
                                                                                                type="email"
                                                                                                name="email"
                                                                                                class="form-control"
                                                                                            
                                                                                                placeholder="Isi Email"
                                                                                                required
                                                                                                value="{{ $p->email }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer no-bd">
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary btn-done">Edit</button>
                                                                                    <button type="button"
                                                                                        class="btn btn-danger"
                                                                                        data-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <form method="POST"
                                                                action="{{ route('penulis.hapus', $p->id) }}">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="button" data-id="{{ $p->id }}"
                                                                    data-name="{{ $p->nama }}"
                                                                    class="btn btn-link btn-danger btn-danger2"
                                                                    id="btnAlert"><i class="fa fa-times"></i></button>
                                                            </form>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody> --}}
                                    <tbody>
                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header no-bd">
                                                        <h5 class="modal-title">
                                                            <span class="fw-mediumbold">
                                                                Edit</span>
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

                                                            <div class="form-group form-group-default">
                                                                <label for="nama" class="col-form-label">Nama:</label>
                                                                <input type="text" class="form-control" id="edit-nama"
                                                                    name="nama" value="" required>
                                                            </div>
                                                            <div class="form-group form-group-default">
                                                                <label for="email"
                                                                    class="col-form-label">Email:</label>
                                                                <input type="text" class="form-control"
                                                                    id="edit-email" name="email" value=""
                                                                    required>
                                                            </div>
                                                            <div class="modal-footer no-bd">
                                                                <button type="button" id="editKategoriButton"
                                                                    class="btn btn-primary btn-berhasil">Add</button>
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <form id="delete-form" action="" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="">
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            // Initialize DataTable
            const table = $('#penulis-table').DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: "{{ route('penulis.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'email',
                        name: 'email'
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
                let email = $('#email').val();

                if (!name || !email) {
                    swal({
                        title: "Error",
                        text: "Field tidak boleh kosong!",
                        icon: "error",
                    });
                    return false;
                }
                $.ajax({
                    url: "/admin/penulis",
                    type: "POST",
                    data: $('#add-form').serialize(),
                    dataType: 'json',
                    success: function(data) {
                        $('#add-form')[0].reset();
                        $('#addModal').modal('hide');
                        swal({
                            title: 'Berhasil!',
                            text: 'Data Berhasil ditambahkan.',
                            icon: 'success'
                        }).then(() => {
                            table.ajax.reload();

                        })
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });

            $('#penulis-table tbody').on('click', '.delete', function() {
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
                            url: "/admin/penulis/" + id,
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




            // Handle Edit Button Click
            $('#penulis-table tbody').on('click', '.edit', function(e) {
                var id = $(this).data('id');
                console.log(id);

                $.ajax({
                    url: '/admin/penulis/' + id + '/edit',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // memasukkan data penulis ke dalam modal
                        $('#editModal').modal('show');
                        $('#edit-nama').val(data.result.nama);
                        $('#edit-email').val(data.result.email);
                        $('#editKategoriButton').on('click', function(e) {
                            e.preventDefault();
                            $.ajax({
                                url: '/admin/penulis/' + id,
                                type: "PUT",
                                data: $('#edit-form').serialize(),
                                dataType: 'json',
                                success: function(data) {
                                    $('#edit-form')[0].reset();
                                    $('#editModal').modal(
                                        'hide');
                                    swal({
                                        title: 'Berhasil!',
                                        text: 'Data Berhasil ditambahkan.',
                                        icon: 'success'
                                    }).then(() => {
                                        location.reload();

                                    })
                                },
                                error: function(data) {
                                    swal({
                                        title: 'Oops!',
                                        text: 'Terjadi kesalahan saat menghapus data.',
                                        icon: 'error'
                                    });;
                                }
                            });
                        })
                    }
                });
            });



        });
    </script>
@endpush
