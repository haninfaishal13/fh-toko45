@extends('_layout.main_backsite')
@section('title', 'Backsite | Category')
@section('content')
    <div class="container mt-3">
        <h3>Kategori Produk</h3>
        <p>Daftar kategori yang digunakan untuk produk</p>
        <div class="card">
            <div class="card-header">
                <button class="btn btn-outline-primary btn-sm me-2 rounded-pill">
                    <i class="fas fa-plus me-2"></i>Tambah Kategori
                </button>
                <button class="btn btn-outline-success btn-sm me-2 rounded-pill">
                    <i class="fas fa-upload me-2"></i>Import Kategori
                </button>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        Urut berdasarkan:
                        
                    </div>
                </div>
                <table class="table table-stripped">
                    <thead>
                        <th style="width: 2%">No</th>
                        <th style="width: 15%">Kode</th>
                        <th>Nama</th>
                        <th style="width: 10%">Aksi</th>
                    </thead>
                    <tbody id="category-table-body">
                        <tr>
                            <td colspan="4">Tidak ada data</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
