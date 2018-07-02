@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Estoque Belíssima Cosméticos</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="flex-center position-ref full-height">
                        <div class="card-body text-center">
                            <img src="{{asset('img/logo-grande.png')}}" alt="" class="rounded">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
