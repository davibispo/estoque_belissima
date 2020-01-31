@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-body">
                    
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Tela de Venda (Esquerda) -->
                            <div class="col-sm-7 tela-venda" style="">
                                <div class="alert alert-success">
                                    <p><b>TELA DE VENDA</b></p>
                                    
                                    {!! Form::open(['method'=>'POST','action'=>['VendaController@store']]) !!}
                                        {!! Form::text('codigo', null, ['class'=>'form-control','autofocus','placeholder'=>'Código do Produto..']) !!}
                                        {!! Form::submit('Adicionar', ['class'=>'form-control btn btn-success btn-sm','style'=>'margin-top:10px', 'data-toggle'=>'tooltip', 'title'=>'Colocar na sacola'])!!}
                                    {!! Form::close() !!}
                                    
                                </div>    
                                <hr>
                                <h5>Consultar Produto</h5>
                                <input name="produto_id" value="" class="form-control" id="myInput" type="text" placeholder="Pesquisa.." autofocus>                          
                                <div style="overflow:auto; height: 250px;">
                                <table class="table table-hover table-sm">
                                    <tr>
                                        <th>Código</th>
                                        <th>Produtos</th>
                                        <th style="width:10%">Valor (R$)</th>
                                        <th style="width:5%">Qtd</th>
                                    </tr>
                                    @forelse ($produtos as $produto)
                                    <tbody id="myTable" style="font-size:12px;">
                                    <tr>
                                        <td>{{$produto->codigo}}</td>
                                        <td>{{$produto->descricao}}</td>
                                        <th>{{number_format($produto->valor, 2, ',', '.')}}</th>
                                        <td>{{$produto->quantidade}}</td>
                                    </tr>
                                    </tbody>    
                                    @empty
                                        <div class="alert-warning">
                                            <p>Não há produtos cadastrados!</p>
                                        </div>
                                    @endforelse
                                </table>
                                </div>
                            </div>
                            <!-- Tela de Comprovante (Direita) -->
                            <div class="col-sm-5 tela-venda" style="background-color:khaki; overflow:auto; height: 480px;">
                                COMPROVANTE <br>
                                <table class="table" style="margin-bottom:0px; padding-bottom:0px">
                                    <tr>
                                        <td class="text-left"><h4>Itens: <b>{{$numProdutosNaCesta}}</b></h4> </td>
                                        <td class="text-right"><h4>Total: <b>R$ {{number_format($valorTotal ,2,',','.')}}</b></h4> </td>
                                    </tr>
                                </table>
                                                   
                                <table class="table table-sm" style="font-size:12px">
                                    @forelse ($vendas as $venda)
                                    <tbody>
                                        <tr>
                                            <td>{{DB::table('produtos')->select('codigo')->where('id',$venda->produto_id)->value('codigo')}}</td>
                                            <td>{{mb_strimwidth(DB::table('produtos')->select('descricao')->where('id',$venda->produto_id)->value('descricao'), 0, 30, "...")}}</td>
                                            <th>R$ {{number_format(DB::table('produtos')->select('valor')->where('id',$venda->produto_id)->value('valor'), 2, ',', '.')}}</th>
                                            <th>
                                                {!! Form::model($venda, ['method'=>'PATCH','action'=>['VendaController@update', $venda->id]]) !!}
                                                    {!! Form::hidden('ativo', '0')!!}
                                                    {!! Form::submit('', ['class'=>'btn btn-danger btn-sm', 'style'=>'font-size:5px', 'data-toggle'=>'tooltip', 'title'=>'Remover item'])!!}
                                                {!! Form::close() !!}
                                            </th>
                                        </tr>
                                    </tbody>    
                                    @empty
                                    <div class="alert alert-warning">
                                        <p>Próximo cliente!</p>
                                    </div>
                                    @endforelse
                                   
                                    <tr>
                                        <th colspan="5" class="text-right">
                                            <a href="{{route('vendas.concluir-venda')}}" accesskey="t" class="btn btn-success" data-toggle="tooltip" title="ALT + T">CONCLUIR VENDA</a>
                                        </th>   
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

