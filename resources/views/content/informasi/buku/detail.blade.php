@extends('layouts.master')
@section('title', 'detail')

@push('css')
    <style>
        .card-text>p {
            font-size: 30px;
        }
    </style>
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
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="card-text text-uppercase">
                                            <p>id buku : {{ $data->id }}</p>
                                            <p>Judul : {{ $data->judul }}</p>
                                            <p>penulis : {{ $data->penulis->nama }}</p>
                                            <p>kategori : {{ $data->kategori->nama }}</p>
                                            <p>penerbit : {{ $data->penerbit }}</p>
                                            <p>tahun terbit : {{ $data->tahun_terbit }}</p>
                                            <p>stok : {{ $data->stok }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="{{ asset('storage/' . $data->gambar) }}" alt="{{ $data->judul }}"
                                            class="card-img-right" width="250">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
