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
                                        <form class="form-inline mb-3">
                                            <div class="form-group mr-2">
                                                <label for="kategori">Kategori:</label>
                                                <select class="form-control" id="kategori">
                                                    <option value="semua">Semua</option>
                                                    <option value="fiksi-fantasi">Fiksi Fantasi</option>
                                                    <option value="fiksi-sastra">Fiksi Sastra</option>
                                                </select>
                                            </div>
                                            <div class="form-group mr-2">
                                                <label for="penulis">Penulis:</label>
                                                <select class="form-control" id="penulis">
                                                    <option value="semua">Semua</option>
                                                    <option value="jk-rowling">J.K. Rowling</option>
                                                    <option value="harper-lee">Harper Lee</option>
                                                    <option value="jd-salinger">J.D. Salinger</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Cari</button>
                                        </form>
                                    </div>
                                    <div class="card-tools">
                                        <form class="form-inline mb-3">
                                            <div class="form-group mr-2">
                                                <input type="text" class="form-control" placeholder="Cari judul buku...">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Cari</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">Harry Potter and the Philosopher's Stone</h5>
                                                <p class="card-text">J.K. Rowling</p>
                                                <small class="text-muted">Fiksi Fantasi</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">To Kill a Mockingbird</h5>
                                                <p class="card-text">Harper Lee</p>
                                                <small class="text-muted">Fiksi Sastra</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">The Catcher in the Rye</h5>
                                                <p class="card-text">J.D. Salinger</p>
                                                <small class="text-muted">Fiksi Sastra</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">Harry Potter and the Philosopher's Stone</h5>
                                                <p class="card-text">J.K. Rowling</p>
                                                <small class="text-muted">Fiksi Fantasi</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">To Kill a Mockingbird</h5>
                                                <p class="card-text">Harper Lee</p>
                                                <small class="text-muted">Fiksi Sastra</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">The Catcher in the Rye</h5>
                                                <p class="card-text">J.D. Salinger</p>
                                                <small class="text-muted">Fiksi Sastra</small>
                                            </div>
                                        </div>
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
