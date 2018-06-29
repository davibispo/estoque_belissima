@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center" style="background-color:thistle;"><b>RELATÓRIO - RESUMO DIÁRIO</b></div>

                <div class="card-body">
                    
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Data da venda</th>
                            <td>{{date('d-m-Y', strtotime($dataVenda))}}</td>
                        </tr>
                        <tr>
                            <th>Número de produtos vendidos</th>
                            <td>{{$numProdVendidos}}</td>
                        </tr>
                        <tr>
                            <th>Valor total</th>
                            <td>R$ {{$totalValor}}</td>
                        </tr>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

