@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center" style="background-color:thistle;"><b>RELATÓRIO ANALÍTICO - RESUMO DIÁRIO</b></div>

                <div class="card-body">

                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Data das vendas</th>
                            <td>12/06/2018</td>
                        </tr>
                        <tr>
                            <th>Número de Itens Vendidos</th>
                            <td>
                                27
                            </td>
                        </tr>
                        <tr>
                            <th>Valor Total</th>
                            <td>R$ 146,25</td>
                        </tr>
                          
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

