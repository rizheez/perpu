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
                                        <a href="{{ route('home.list') }}" class="btn btn-info btn-round btn-sm mr-2">
                                            <span class="btn-label">
                                                <i class="fa fa-pencil"></i>
                                            </span>
                                            View More
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mx-sm-3 mx-auto mt-3">

                                    @foreach ($data as $d)
                                        <div class="col mb-5">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
