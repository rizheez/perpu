@extends('layouts.master')
@section('title', 'Edit Buku')


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
                            <p>Edit</p>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Data Buku</div>
                    </div>
                    <form id="form-edit" action="{{ route('buku.edit', $data->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" id="judul" placeholder="Masukkan Judul"
                                    name="judul" value="{{ $data->judul }}">
                            </div>
                            <div class="form-group">
                                <label for="penulis">Penulis</label>
                                <input type="text" class="form-control" id="penulis" placeholder="Masukkan penulis"
                                    name="penulis" value="{{ $data->penulis }}">
                            </div>

                            <div class="form-group pt-2">
                                <label for="kategori_id">Kategori</label>
                                <select class="form-control selectpicker border border-muted" data-live-search="true"
                                    id="kategori" name="kategori_id">
                                    <option disabled>-- Pilih Kategori --</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id }}"
                                            {{ $k->id == $data->penulis_id ? 'selected' : '' }}>
                                            {{ $k->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="penerbit_id">Penerbit</label>
                                <select class="form-control selectpicker border border-muted" data-dropup-auto="false"
                                    data-live-search="true" id="penerbit" name="penerbit_id">
                                    <option disabled>-- Pilih Penerbit --</option>
                                    @foreach ($penerbit as $p)
                                        <option value="{{ $p->id }}"
                                            {{ $p->id == $data->penerbit_id ? 'selected' : '' }}>
                                            {{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tahun_terbit">Tahun Terbit</label>
                                <input type="text" min="2000" max="2022" class="form-control" id="tahun_terbit"
                                    name="tahun_terbit" placeholder="Tahun" value={{ $data->tahun_terbit }}>
                            </div>
                            <div class="form-group">
                                <label for="Stok">Stok</label>
                                <input type="number" min="0" max="500" class="form-control" id="Stok"
                                    name="stok" placeholder="Stok" value="{{ $data->stok }}">
                            </div>
                            <div class="form-group d-flex flex-column">
                                <label class="fw-bold" for="gambar">Upload File Gambar Untuk Mengubah Gambar <p>(Abaikan
                                        jika
                                        tidak ingin mengubah
                                        gambar)</p></label>
                                <p id="preview-text" class="mt-2" style="display:none">Preview Gambar</p>
                                <img id="preview" src="" alt="" style="max-width: 150px">
                                {{-- <input type="file" class="form-control-file" id="gambar" name="gambar"> --}}
                                <input type="file" name="gambar" id="gambar" class="form-control-file mt-3"
                                    onchange="previewImage(event)">
                            </div>
                        </div>
                        <div class="card-action d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ route('buku.index') }}" class="btn btn-danger">Cancel</a>
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

    <script>
        document.querySelector('#form-edit').addEventListener('submit', (e) => {
            e.preventDefault();


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
