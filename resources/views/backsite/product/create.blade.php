@extends('_layout.main_backsite')
@section('title', 'Backsite | Produk')
@section('content')
    <div class="container mt-3">
        <div class="d-flex justify-content-between mb-3">
            <h3>Tambah Produk</h3>
            <button class="btn btn-primary btn-sm" id="new-form"><i class="fas fa-plus"></i></button>
        </div>
        <div class="card">
            <form id="add-product-form">
                <div class="card-body" id="add-product">
                    <div class="mb-2 product-data">
                        <button type="button" class="btn btn-danger btn-sm mb-2 remove-form d-none"><i class="fas fa-minus"></i></button>
                        <div class="row">
                            <div class="col-lg-3 col-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        Nama
                                        <input type="text" class="form-control product-name" name="name[]" placeholder="Nama produk">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        Kategori
                                        <select name="category_id[]" class="form-control product-category" id="filter-category" aria-placeholder="Pilih Kategori"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        Jumlah
                                        <input type="number" class="form-control product-quantity" name="quantity[]" placeholder="Jumlah produk">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        Harga
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control product-price" name="price[]" placeholder="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="file" name="product_image[]" class="form-control product-image" accept="image/*">
                        <hr>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button class="btn btn-success"><i class="far fa-save mr-2"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('after-script')
    <script src="{{asset('js/filter.js')}}"></script>
    <script src="{{asset('js/backsite/product/create.js')}}"></script>
@endsection
