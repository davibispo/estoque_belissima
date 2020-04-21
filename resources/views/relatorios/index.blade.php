@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center" style="background-color:thistle;"><b>RELATÓRIO GERAL DE VENDAS</b></div>

                <div class="card-body">
                    <input class="form-control" id="myInput" type="text" placeholder="Filtrar..">
                    <div style="overflow:auto; height: 480px;">
                    <table class="table table-hover table-sm">
                        <tr>
                            <th colspan="2">Produtos vendidos</th>
                            <th>Valor (R$)</th>
                            <th>Data e hora</th>
                            <th>Vendedor(a)</th>
                        </tr>
                        @forelse ($vendas as $venda)
                        <tbody id="myTable" style="font-size:12px">
                        <tr>
                            <td>{{DB::table('produtos')->select('codigo')->where('id', $venda->produto_id)->value('codigo')}}</td>
                            <td>{{DB::table('produtos')->select('descricao')->where('id', $venda->produto_id)->value('descricao')}}</td>
                            <td>{{number_format(DB::table('vendas')->select('preco')->where('produto_id', $venda->produto_id)->value('preco'), 2, ',', '.')}}</td>
                            <td>{{date('d/m/y', strtotime($venda->data_venda))}} - {{date('H:i', strtotime($venda->created_at))}}</td>
                            <td>{{DB::table('users')->select('name')->where('id', $venda->user_id)->value('name')}}  </td>
                        </tr>
                        </tbody>    
                        @empty
                        <div class="alert alert-warning">
                            <p>Não há vendas ainda!</p>
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

