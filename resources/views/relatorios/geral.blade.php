@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center" style="background-color:thistle;"><b>RELATÓRIO GERAL DE VENDAS</b></div>

                <div class="card-body">
                    <input class="form-control" id="myInput" type="text" placeholder="Filtrar..">
                    <br>
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Produto vendido</th>
                            <th>Valor (R$)</th>
                            <th>Data da venda</th>
                        </tr>
                        @forelse ($vendas as $venda)
                        <tbody id="myTable" style="font-size:12px">
                        <tr>
                            <td>
                                {{DB::table('produtos')->select('nome')->where('id', $venda->produto_id)->value('nome')}} - 
                                {{DB::table('produtos')->select('descricao')->where('id', $venda->produto_id)->value('descricao')}}
                            </td>
                            <td>{{DB::table('vendas')->select('preco')->where('produto_id', $venda->produto_id)->value('preco')}}</td>
                            <td>{{date('d/m/y -  H:i', strtotime($venda->data_venda))}}</td>
                        </tr>
                        </tbody>    
                        @empty
                            <div class="alert-warning">
                                <p>Não há vendas ainda!</p>
                            </div>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

