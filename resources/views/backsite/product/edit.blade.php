@extends('_layout.main_backsite')
@section('title', 'Backsite | Produk')
@section('content')
    <div class="container mt-3">
        <div class="d-flex justify-content-between mb-3">
            <h3>Edit Produk</h3>
        </div>
        <div class="card">
            <form id="edit-product-form" data-id="{{$id}}">
                <div class="card-body" id="add-product">
                    <div class="mb-2 product-data">
                        <div class="row">
                            <div class="col-lg-3 col-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        Nama
                                        <input type="text" class="form-control product-name" name="name" placeholder="Nama produk" id="product-name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        Kategori
                                        <select name="category_id" class="form-control product-category" id="filter-category" aria-placeholder="Pilih Kategori"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        Jumlah
                                        <input type="number" class="form-control product-quantity" name="quantity" placeholder="Jumlah produk" id="product-quantity">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        Harga
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control product-price" name="price" placeholder="0" id="product-price">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="file" name="product_image[]" class="form-control product-image" accept="image/*" multiple>
                        <hr>
                        <h5 class="mb-2 mt-4">Gambar produk tersedia:</h5>
                        <div class="row" id="exist-image"></div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button class="btn btn-success"><i class="far fa-save mr-2"></i> Edit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('after-script')
    <script src="{{asset('js/filter.js')}}"></script>
    <script src="{{asset('js/backsite/product/edit.js')}}"></script>
    {{-- <script src="{{asset('js/backsite/product/create.js')}}"></script> --}}
@endsection
