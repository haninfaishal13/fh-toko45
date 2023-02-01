@extends('_layout.main')
@section('title', 'Welcome')
@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                Gambar
            </div>
        </div>
    </div>
    @include('partials.modal-auth')
@endsection
@section('after-script')
    <script src="{{asset('js/index.js')}}"></script>
@endsection

