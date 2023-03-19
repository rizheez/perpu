@extends('layouts.master')
@section('title', 'CETAK ANGGOTA')

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
                            <p>Master Data</p>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <p>Anggota</p>
                        </li>
                    </ul>
                </div>




                <div class="card">
                    <img src="{{ asset('assets/img/kartu.jpg') }}" class="card-img-top" alt="Kartu Anggota">
                    <div class="card-body">
                        <h5 class="card-title">{{ $anggota->nama }}</h5>
                        <p class="card-text">{{ $anggota->alamat }}</p>
                        <!-- tambahkan data lainnya sesuai dengan template kartu anggota -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
