@extends('layouts.home.master')
@section('title', 'DATA BUKU')


@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="row">
                    <div class="col-md">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-head-row">
                                    <div class="card-title">Daftar Buku</div>
                                    <div class="card-tools">
                                        <form class="form-inline mb-3" method="GET" action="{{ route('home.list') }}">
                                            <div class="form-group mr-2">
                                                <label for="kategori">Kategori:</label>
                                                <select class="form-control" id="kategori" name="kategori">
                                                    <option value="semua">Semua</option>
                                                    @foreach ($kategori as $d)
                                                        {{-- <option value="{{ $d->nama }}">{{ $d->nama }}

                                                    </option> --}}
                                                        <option value="{{ $d->nama }}"
                                                            @if (session('kategori_id') == $d->nama) selected @endif>
                                                            {{ $d->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{-- <div class="form-group mr-2">
                                                <label for="penulis">Penulis:</label>
                                                <select class="form-control" id="penulis">
                                                    <option value="semua">Semua</option>
                                                    <option value="jk-rowling">J.K. Rowling</option>
                                                    <option value="harper-lee">Harper Lee</option>
                                                    <option value="jd-salinger">J.D. Salinger</option>
                                                </select>
                                            </div> --}}
                                            <button type="submit" class="btn btn-primary">Cari</button>
                                        </form>
                                    </div>
                                    <div class="card-tools">
                                        <form class="form-inline mb-3" method="GET" action="{{ route('home.list') }}">
                                            <div class="form-group mr-2">
                                                <input type="text" class="form-control" placeholder="Cari judul buku..."
                                                    name="search">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Cari</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @if (session('message'))
                                <div class="alert alert-warning">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($data as $d)
                                        <div class="col-md-3 mb-5">
                                            <div class="card" style="width: 300px">
                                                <img src="{{ asset('storage/buku/gambar/' . $d->gambar) }}"
                                                    class="card-img-top" alt="..." style="height : 390px">
                                                <div class="card-body d-flex flex-column">
                                                    <h5 class="card-title">{{ $d->judul }}</h5>
                                                    <p class="card-text">{{ $d->penulis }}</p>
                                                    <small class="text-muted">{{ $d->kategori->nama }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                {{ $data->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection