@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Estoque</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="flex-center position-ref full-height">
                        <div class="card-body text-center">
                            Bem-vindo!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
