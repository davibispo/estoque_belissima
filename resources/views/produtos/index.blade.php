@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center" style="background-color:thistle;"><b>PRODUTOS</b></div>

                <div class="card-body">
                    <div class="text-left">
                        <a href=" {{route('produtos.create')}} " class="btn btn-dark btn-sm">Cadastrar Novo Produto</a>
                    </div>
                    <br>
                    <h5>Existem <b>{{ $qdtProdutos }}</b> produtos cadastrados.</h5>
                    <input class="form-control" id="myInput" type="text" placeholder="Filtrar.." autofocus>
                    <div style="overflow:auto; height: 500px;">
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

