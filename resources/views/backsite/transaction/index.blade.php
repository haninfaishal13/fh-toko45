@extends('_layout.main_backsite')
@section('title', 'Backsite | Transaction')
@section('content')
    <div class="container mt-3">
        <h3>Transaksi</h3>
        <p>List riwayat transaksi</p>
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between">
                <h5>Riwayat Transaksi</h5>
                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-new-transaction">
                    <i class="fas fa-plus me-2"></i>Tambah transaksi baru
                </button>
            </div>
            <div class="card-body overflow-x-scroll">
                <table class="table table-stripped">
                    <thead>
                        <th>Kode Transaksi</th>
                        <th>Total Transaksi</th>
                        <th>Tanggal</th>
                        <th>#</th>
                    </thead>
                    <tbody id="table-transaction-body">
                        {{-- <tr>
                            <td>T-0000000000</td>
                            <td>Rp25000</td>
                            <td>25 April 2022</td>
                            <td>
                                <button class="btn btn-outline-primary btn-sm" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-outline-warning btn-sm" title="Edit">
                                    <i class="far fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('partials.modal-create-transaction')
@endsection
@section('after-script')
    <script src="{{asset('js/backsite/transaction/index.js')}}"></script>
@endsection
