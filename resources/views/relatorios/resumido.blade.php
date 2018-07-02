@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center" style="background-color:thistle;"><b>RELATÓRIO - RESUMO DE VENDAS DO DIA</b></div>

                <div class="card-body">
                    <div class="container">
                    {!! Form::open(['method'=>'post', 'action'=>'RelatorioController@resumido', 'class'=>'form-inline']) !!}
                        {!! Form::label('data', 'Escolha o dia:', ['class'=>'mr-sm-2']) !!}
                        {!! Form::date('data', null, ['class'=>'form-control mr-sm-2']) !!}
                        {!! Form::submit('Ver',['class'=>'btn btn-success']) !!}
                    {!! Form::close() !!}
                    </div>
                    <br>
                    <table class="table table-bordered table-dark table-striped text-center">
                        <tbody>
                            <tr>
                                <td style="width:50%">Número de produtos vendidos</td>
                                <td style="width:50%">Valor total</td>
                            </tr>
                            <tr>
                                <th><h3>{{ $numProdutosVendidos }}</h3></th>
                                <th><h3>R$ {{ number_format($valorTotal, 2, ',', '.') }}</h3></th>
                            </tr>
                        </tbody>  
                    </table>
                    <br>
                    <table class="table table-bordered table-hover table-sm">
                            <tr>
                                <th colspan="2">Produtos vendidos</th>
                                <th>R$</th>
                                <th>Dia e hora</th>
                            </tr>
                            @foreach ($vendas as $venda)
                            <tbody id="myTable" style="font-size:12px">
                            <tr>
                                <td>{{DB::table('produtos')->select('codigo')->where('id', $venda->produto_id)->value('codigo')}}</td>
                                <td>
                                    {{DB::table('produtos')->select('nome')->where('id', $venda->produto_id)->value('nome')}} - 
                                    {{DB::table('produtos')->select('descricao')->where('id', $venda->produto_id)->value('descricao')}}
                                </td>
                                <td>{{number_format(DB::table('vendas')->select('preco')->where('produto_id', $venda->produto_id)->value('preco'), 2, ',', '.')}}</td>
                                <td>{{date('d/m/y', strtotime($venda->data_venda))}} - {{date('H:i', strtotime($venda->created_at))}}</td>
                            </tr>
                            </tbody>
                            @endforeach
                            
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

