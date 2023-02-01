<div class="modal fade" id="modal-new-transaction" tabindex="-1" aria-labelledby="new-transaction-label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="new-transaction-label">Transaksi Baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="d-flex justify-content-between mb-3">
                            <h5>Produk</h5>
                            <form id="search-product">
                                <input type="text" id="search-prodcut" class="form-control" placeholder="Cari produk">
                            </form>
                        </div>
                        <div class="row">
                            @for ($i=0 ; $i<4 ; $i++)
                                <div class="col-6 col-lg-4 mb-3" id="product-{{$i}}">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="data-card-header">
                                                <p class="my-0 fw-semibold">Name {{$i}}</p>
                                                <span class="fw-6 fw-semibold text-secondary">Category {{$i}}</span>
                                            </div>
                                            <img src="{{asset('assets/image/keranjang.jpg')}}" class="my-4" alt="" style="height:5em;width:100%;object-fit:cover">
                                            <div class="d-flex flex-md-column justify-content-between">
                                                <span class="text-success fw-semibold" data-price="100">Rp 100</span>
                                                <span class="fw-semibold" data-quantity="10">10 buah</span>
                                            </div>
                                            <div class="d-flex justify-content-center mt-2">
                                                <button class="btn btn-outline-primary btn-sm btn-detail" data-id="{{$i}}" title="Tampil">
                                                    <i class="fas fa-check-square"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="col-6">
                        <h5>Transaksi</h5>

                    </div>
                </div>
            </div>
            {{-- <form id="form-transaction">
                <div class="modal-body">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th style="width:25%;">Barang</th>
                                <th style="width:25%;">Jumlah</th>
                                <th style="width:24%;">Harga</th>
                                <th style="width:24%;">Total harga</th>
                                <th style="width:2%;">#</th>
                            </tr>
                        </thead>
                        <tbody id="form-transaction-field">
                            <tr class="form-transaction-input">
                                <td>
                                    <select name="product_name[]" id="" class="form-control">
                                        <option value="1">Pencil</option>
                                        <option value="2">Bolpoin</option>
                                        <option value="3">Penggaris</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="product_quantity[]" class="form-control product-quantity" min="0" max="100" placeholder="0">
                                </td>
                                <td>
                                    <input type="number" name="product_price[]" class="form-control product-price" value="50000" value="0" disabled>
                                </td>
                                <td>
                                    <input type="number" name="product_total_price[]" class="form-control product-total-price" value="0" disabled>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm btn-remove-item d-none"><i class="fas fa-minus"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form> --}}

        </div>
    </div>
</div>
