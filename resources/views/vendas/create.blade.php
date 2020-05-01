<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">


        <title>Belíssima Cosméticos</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color:cornflowerblue;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .container {
                margin-top: 2%
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;    
            }

            .links > a:hover {
                text-decoration: underline;
            }
            
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h3 class="text-center text-white"><b>Módulo de Venda</b></h3>
                    <table>
                        <tr>
                            <td><a href="{{ url('/') }}" class="btn btn-dark btn-sm">Home</a></td>
                            <td>Atendente: {{ auth()->user()->name }}</td>
                        </tr>
                    </table>

                    <div class="card">
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <!-- Tela de Venda (Esquerda) -->
                                    <div class="col-sm-5">
                                        <div class="alert alert-success">
                                            <p><b>CAIXA</b></p>
                                            {!! Form::open(['method'=>'POST','action'=>['VendaController@store']]) !!}
                                                {!! Form::text('codigo', null, ['class'=>'form-control','autofocus','placeholder'=>'Código do Produto..']) !!}
                                                {!! Form::submit('Adicionar', ['class'=>'form-control btn btn-link btn-sm','style'=>'margin-top:10px', 'data-toggle'=>'tooltip', 'title'=>'Colocar na sacola'])!!}
                                            {!! Form::close() !!}    
                                        </div>    
                                        <hr>
                                        <div class="links text-center">
                                            <a href="{{route('produtos.index')}}"><i class="fas fa-search"></i> CONSULTAR PRODUTOS</a><br>
                                            <a href="{{route('relatorios.index')}}"><i class="fas fa-file-alt"></i> Relatório Geral</a>
                                        </div>

                                        <div class="text-center" style="margin-top:35%">
                                            <img src="{{asset('img/logo.png')}}" alt="Logo" width="150" class="rounded">
                                        </div>
                                    </div>
                                    <!-- Tela de Comprovante (Direita) -->
                                    <div class="col-sm-7" style="background-color:khaki; overflow:auto; height: 480px;">
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
                                                    <th>{{mb_strimwidth(DB::table('produtos')->select('descricao')->where('id',$venda->produto_id)->value('descricao'), 0, 30, "...")}}</th>
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
                                                    <a href="{{route('vendas.concluir-venda')}}" accesskey="c" class="btn btn-success" data-toggle="tooltip" title="ALT + c">CONCLUIR VENDA</a>
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
    </body>
</html>
