@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center" style="background-color:thistle;"><b>CADASTRAR NOVO PRODUTO</b></div>

                <div class="card-body">                
                    {!!Form::open(['method'=>'post', 'action'=>'ProdutoController@store', 'class'=>'form-horizontal'])!!}
                    
                        <div class="form-group row">
                            {!! Form::label('codigo', 'Código do Produto', ['class'=>'col-sm-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('codigo', null, ['class'=>'form-control','autofocus']) !!}
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            {!! Form::label('descricao', 'Descrição', ['class'=>'col-sm-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('descricao', null, ['class'=>'form-control','maxlength'=>'60', 'required','autofocus']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('valor', 'Valor', ['class'=>'col-sm-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('valor', null, ['class'=>'form-control', 'required','autofocus']) !!}
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            {!! Form::label('quantidade', 'Quantidade', ['class'=>'col-sm-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::text('quantidade', 1, ['class'=>'form-control', 'required','autofocus']) !!}
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                {!! Form::submit('Cadastrar', ['class'=>'btn btn-dark']) !!}
                                <a href="{{route('produtos.index')}}" class="btn btn-light" role="button">Retornar</a>
                            </div>
                        </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection