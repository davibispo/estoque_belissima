@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center" style="background-color:thistle;"><b>RELATÓRIO - RESUMO DIÁRIO</b></div>

                <div class="card-body">
                    
                    <table class="table table-bordered table-hover">
                        {!! Form::open(['method'=>'POST', 'action'=>'RelatorioController@store', 'class'=>'form-horizontal']) !!}
                        <tr>
                            <th>Data da venda:</th>
                            <td>
                                <select name="" id="">
                                    @foreach ($vendas as $venda)
                                    <option value="{{ date('d-m-Y', strtotime($venda->data_venda)) }}">{{ date('d-m-Y', strtotime($venda->data_venda)) }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>{!! Form::submit('Gerar', ['class'=>'btn btn-outline-dark']) !!}</td>
                        </tr>
                        {!! Form::close() !!}
                        <tr>
                            <td>TOTAL: </td>
                            <td colspan="3"></td>
                        </tr>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

