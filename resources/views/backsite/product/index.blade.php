@extends('_layout.main_backsite')
@section('title', 'Backsite | Product')
@section('content')
    <div class="container mt-3">
        <h3>Product</h3>
        <p>List product</p>
        <div class="d-flex mb-3">
            <a href="{{route('backsite.product.create')}}" class="btn btn-outline-primary btn-sm rounded-pill">
                <i class="fas fa-plus-circle me-2"></i>Tambah produk baru
            </a>
            <button class="btn btn-outline-success btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#import-modal">
                <i class="fas fa-upload me-2"></i>Import produk
            </button>
        </div>
        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between mb-2">
                    <button class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#filter-product" aria-expanded="false" aria-controls="filter-product">
                        Filter
                    </button>
                    <form id="search-product">
                        <input type="text" class="form-control" id="search-input" placeholder="Search..">
                    </form>
                </div>
                <div class="collapse" id="filter-product">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-lg-4 col-12 mb-2">
                                Kategori
                                <select name="filter_category" id="filter-category" class="form-control select"></select>
                            </div>
                            <div class="col-lg-4 col-12 mb-2">
                                Urut Berdasarkan Harga
                                <select name="filter_order_price" id="filter-order-price" class="form-control select"></select>
                            </div>
                            <div class="col-lg-4 col-12 mb-2">
                                Urut Berdasarkan Stok
                                <select name="filter_order_quantity" id="filter-order-quantity" class="form-control select"></select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-danger me-2" id="reset-filter"><i class="fas fa-redo me-2"></i>Reset Filter</button>
                            <button class="btn btn-primary" id="filter"><i class="fas fa-filter me-2"></i>Filter</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="loadData" class="row">
                </div>
                <div id="div-load-more" class="d-flex justify-content-center">
                    <button class="btn btn-outline-primary btn-sm" id="load-more">
                        <i class="fas fa-sync-alt me-2"></i>Muat lagi
                    </button>
                </div>
            </div>
        </div>
    </div>
    @include('partials.backsite.modal-import-product')
@endsection
@section('after-script')
    <script src="{{asset('js/filter.js')}}"></script>
    <script src="{{asset('js/backsite/product/index.js')}}"></script>
@endsection

