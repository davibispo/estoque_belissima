@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center" style="background-color:lightgreen;"><b>ABERTURA DE VENDA</b></div>

                <div class="card-body">
                    <h3>Produtos na cesta: <b>{{$numProdutosNaCesta}}</b></h3>                    
                    <table class="table table-hover table-success" style="font-size:12px">
                        <tr>
                            <th>Código</th>
                            <th>Nome do produto</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th></th>
                        </tr>
                        @forelse ($vendas as $venda)
                        <tbody>
                            <tr>
                                <td>{{DB::table('produtos')->select('codigo')->where('id',$venda->produto_id)->value('codigo')}}</td>
                                <td>{{DB::table('produtos')->select('nome')->where('id',$venda->produto_id)->value('nome')}}</td>
                                <td>{{DB::table('produtos')->select('descricao')->where('id',$venda->produto_id)->value('descricao')}}</td>
                                <th>R$ {{number_format(DB::table('produtos')->select('valor')->where('id',$venda->produto_id)->value('valor'), 2, ',', '.')}}</th>
                                <th>
                                    {!! Form::model($venda, ['method'=>'DELETE','action'=>['VendaController@destroy', $venda->id]]) !!}
                                        {!! Form::hidden('ativo', '0')!!}
                                        {!! Form::submit('', ['class'=>'btn btn-danger btn-sm', 'style'=>'font-size:5px', 'data-toggle'=>'tooltip', 'title'=>'Remover item'])!!}
                                    {!! Form::close() !!}
                                </th>
                            </tr>
                        </tbody>    
                        @empty
                        <div class="alert-warning">
                            <p>Não há produtos na cesta!</p>
                        </div>
                        @endforelse
                       
                        <tr style="background-color:white">
                            <th colspan="5" class="text-right">
                                <h4>Total: R$ <b>{{number_format($valorTotal ,2,',','.')}}</b></h4> 
                                <a href="{{route('vendas.concluir-venda')}}" style="display:inline;" class="btn btn-success">CONCLUIR VENDA</a>
                            </th>   
                        </tr>
                    </table>
                    
                    <input name="produto_id" class="form-control" id="myInput" type="text" placeholder="Filtrar..">                          
                    <br>
                    
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Código</th>
                            <th>Nome do Produto</th>
                            <th>Descrição</th>
                            <th style="width:10%">Valor (R$)</th>
                            <th style="width:5%">Qtd</th>
                            <th>Adicionar</th>
                        </tr>
                        @forelse ($produtos as $produto)
                        <tbody id="myTable" style="font-size:12px">
                        <tr>
                            <td>{{$produto->codigo}}</td>
                            <td>{{$produto->nome}}</td>
                            <td>{{$produto->descricao}}</td>
                            <th>{{number_format($produto->valor, 2, ',', '.')}}</th>
                            <td>{{$produto->quantidade}}</td>
                            
                            <td style="width:1%">
                                {!! Form::open(['method'=>'POST','action'=>['VendaController@store', $produto->id]]) !!}
                                    {!! Form::hidden('produto_id', $produto->id) !!}
                                    {!! Form::hidden('preco', $produto->valor) !!}
                                    {!! Form::submit('', ['class'=>'btn btn-success btn-sm', 'style'=>'font-size:5px', 'data-toggle'=>'tooltip', 'title'=>'Adicionar'])!!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        </tbody>    
                        @empty
                            <div class="alert-warning">
                                <p>Não há produtos reservados para venda!</p>
                            </div>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

