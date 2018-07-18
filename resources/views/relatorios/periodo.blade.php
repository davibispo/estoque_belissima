@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center" style="background-color:thistle;"><b>RELATÓRIO DO PERÍODO</b></div>

                <div class="card-body">
                    <div class="container">
                    {!! Form::open(['method'=>'post', 'action'=>'RelatorioController@periodo', 'class'=>'form-inline']) !!}
                        <b>{!! Form::label('dataInicio', 'de:', ['class'=>'mr-sm-2']) !!}</b>
                        {!! Form::date('dataInicio', null, ['class'=>'form-control mr-sm-2','required']) !!}
                        <b>{!! Form::label('dataFim', 'a:', ['class'=>'mr-sm-2']) !!}</b>
                        {!! Form::date('dataFim', null, ['class'=>'form-control mr-sm-2','required']) !!}
                        {!! Form::submit('Ver',['class'=>'btn btn-success']) !!}
                    {!! Form::close() !!}
                    </div>
                    <br>
                    <a onclick="javascript:window.print();" class="btn btn-link">
                        <i class="fas fa-print"></i>
                        <b>Impressão</b>
                    </a>
                    <table class="table table-bordered table-dark table-striped text-center">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    Relatório de vendas do período de <b>{{ date('d-m-Y', strtotime($dataInicio)) }}</b> a <b>{{ date('d-m-Y', strtotime($dataFim)) }}</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50%">Número de produtos vendidos</td>
                                <td style="width:50%">Valor total do período</td>
                            </tr>
                            <tr>
                                <th><h3>{{ $numProdutosVendidos }}</h3></th>
                                <th><h3>R$ {{ number_format($valorTotal, 2, ',', '.') }}</h3></th>
                            </tr>
                        </tbody>  
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

