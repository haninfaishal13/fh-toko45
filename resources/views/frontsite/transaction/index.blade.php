@extends('_layout.main')
@section('title', 'Transaksi')
@section('content')
    <div class="container bg-white pt-5">
        <div class="card">
            <div class="card-body">
                <form id="form-transaction">
                    <h5>Transaksi</h5>
                    <div id="form-transaction-input"></div>
                    <hr>
                    <input type="text" name="notes" class="form-control mb-2" id="transaction-notes" placeholder="Beri catatan transaksi di sini...">
                    <div class="d-flex justify-content-between">
                        <div>
                            Total transaksi:
                            <input type="number" name="transaction_total" id="transaction-total" class="form-control" value="0" disabled>
                        </div>
                        <div class="d-flex flex-column">
                            <div>
                                Dibayar: <input type="checkbox" id="transaction-status" checked>
                            </div>
                            <button type="button" class="btn btn-primary btn-sm" id="btn-submit">Simpan</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>Pilih Produk</h5>
                    <form id="search-product">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari produk" id="input-search-product">
                            <button type="button" class="btn btn-danger btn-sm" id="clear-input">X</button>
                        </div>
                    </form>
                </div>
                <div class="row" id="load-data"></div>
                <div class="div-btn-load-data d-flex justify-content-center">
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-sync-alt me-2"></i>Muat lagi
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after-script')
    <script src="{{asset('js/frontsite/transaction/index.js')}}"></script>
@endsection
