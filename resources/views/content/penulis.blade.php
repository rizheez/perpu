@extends('layouts.master')
@section('title', 'DATA PENULIS')

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
                            <span>Informasi</span>
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
                                    <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#addRowModal">
                                        <i class="fa fa-plus"></i>
                                        Tambah Data
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Modal -->
                                <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                <form id='form_penulis' method="post"
                                                    action="{{ route('penulis.tambah') }}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label for="nama">Nama</label>
                                                                <input id="nama" type="text" name="nama"
                                                                    class="form-control" placeholder="Isi Nama" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label for="email">Email</label>
                                                                <input id="email" type="email" name="email"
                                                                    class="form-control" placeholder="Isi Email" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer no-bd">
                                                        <button type="submit" id="addRowButton"
                                                            class="btn btn-primary btn-berhasil">Add</button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach ($penulis as $p)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $p->nama }}</td>
                                                    <td>{{ $p->email }}</td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a href="{{ route('penulis.update', $p->id) }}"
                                                                class="btn btn-link btn-primary btn-lg">

                                                                <i class="fa fa-edit"></i>
                                                            </a>

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

@push('script')
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $(document).on('click', '.btn-berhasil', function() {
            event.preventDefault();
            $.ajax({
                url: "{{ route('penulis.tambah') }}",
                type: 'POST',
                data: $('#form_penulis').serialize(),
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
                        text: 'Terjadi kesalahan saat menghapus data.',
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
                        url: '{{ url('/penulis') }}/' + id,
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
                $('#add-row').dataTable().fnAddData([
                    counter,
                    $("#nama").val(),
                    $("#email").val(),
                    action
                ]);
                counter++;
                $('#addRowModal').modal('hide');

            });
        });
    </script>
@endpush
