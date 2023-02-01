@extends('_layout.main_backsite')
@section('title', 'Backsite | Dashboard')
@section('content')
    <div class="container mt-3">
        <h3>Dashboard</h3>
        <div class="row my-3">
            <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb-3">
                <div class="card bg-warning">
                    <div class="card-body">
                        <span class="opacity-75 fw-semibold">Total Kategori Barang</span>
                        <h1 id="category-count"  class="opacity-75 fw-bold mt-2 text-end">-</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb-3">
                <div class="card bg-primary">
                    <div class="card-body">
                        <span class="opacity-75 fw-semibold">Total Barang</span>
                        <h1 id="product-count" class="opacity-75 fw-bold mt-2 text-end">-</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb-3">
                <div class="card bg-success">
                    <div class="card-body">
                        <span class="opacity-75 fw-semibold">Total Transaksi</span>
                        <h1 id="transaction-count" class="opacity-75 fw-bold mt-2 text-end">-</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-12 col-sm-6 col-12 mb-3">
                <div class="card bg-info">
                    <div class="card-body">
                        <span class="opacity-75 fw-semibold">Total User</span>
                        <h1 id="user-count" class="opacity-75 fw-bold mt-2 text-end">-</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-2">Statistik Transaksi</h5>
                        <select id="select-month-transaction" class="form-select">
                            <option value="">Pilihan Bulan</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                        </select>
                        <div id="statistic-transaction-chart">
                            <canvas id="statistic-transaction" width="500" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-2">Statistik Produk</h5>
                        <select id="select-month-product" class="form-select">
                            <option value="">Pilihan Bulan</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                        </select>
                        <div class="d-flex justify-content-center" id="statistic-product-chart" class="mt-3">
                            <canvas id="statistic-product" width="500" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after-script')
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <script src="{{asset('assets/js/chart/Chart.min.js')}}"></script>
    <script src="{{asset('js/backsite/dashboard/index.js')}}"></script>
@endsection
