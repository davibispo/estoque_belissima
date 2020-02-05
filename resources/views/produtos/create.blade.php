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
                            {!! Form::label('valor', 'Valor (R$)', ['class'=>'col-sm-4 col-form-label text-md-right']) !!}
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
                    <br>
                    <div style="overflow:auto; height: 300px;">
                        <table class="table table-hover table-sm">
                            <tr>
                                <th>Código</th>
                                <th>Descrição</th>
                                <th style="width:10%">R$</th>
                                <th style="width:5%">Qtd</th>
                                <th colspan="2" class="text-center">Ações</th>
                            </tr>
                            @forelse ($produtos as $produto)
                            <tbody id="myTable" style="font-size:12px">
                            <tr>
                                <td>{{$produto->codigo}}</td>
                                <td>{{$produto->descricao}}</td>
                                <th>{{number_format($produto->valor, 2, ',', '.')}}</th>
                                <td>{{$produto->quantidade}}</td>
                                <td style="width:1%">
                                    <a href="{{route('produtos.edit', $produto->id)}}" class="btn btn-warning btn-sm" data-toggle="tooltip", title="Editar" style="font-size:5px">.</a>
                                </td>
                                <td style="width:1%">
                                    {!! Form::model($produto, ['method'=>'DELETE','action'=>['ProdutoController@destroy', $produto->id]]) !!}
                                        {!! Form::hidden('ativo', '0')!!}
                                        {!! Form::submit('', ['class'=>'btn btn-danger btn-sm', 'style'=>'font-size:5px', 'data-toggle'=>'tooltip', 'title'=>'Excluir'])!!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            </tbody>    
                            @empty
                                <div class="alert alert-warning">
                                    <p>Não há produtos cadastrados!</p>
                                </div>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection