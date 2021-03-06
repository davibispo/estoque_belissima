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
        <!-- Mascaras  -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
        <script>
            $(document).ready(function () {
                $('#valor').mask('000.000.000.000.000.00' , { reverse : true});
            });
        </script>
        <!-- fim de mascaras-->
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h3 class="text-center text-white"><b style="background-color: #1b3054ff; border-radius: 20px; padding:0px 10px 0px 10px;">Módulo de Venda</b></h3>
                    <p>Funcionário: {{ auth()->user()->name }}</p>
                    <div class="card">
                        <div class="card-body">
                            <div class="container-fluid">
                                <h1>TROCO</h1>
                                <table class="table">
                                    <tr>
                                        <th>Código</th>
                                        <th>Produto</th>
                                        <th>Preço</th>
                                    </tr>
                                    <tbody>
                                    @foreach ($vendas as $venda)
                                        <tr>
                                            <td>{{DB::table('produtos')->select('codigo')->where('id',$venda->produto_id)->value('codigo')}}</td>
                                            <td>{{mb_strimwidth(DB::table('produtos')->select('descricao')->where('id',$venda->produto_id)->value('descricao'), 0, 30, "...")}}</td>
                                            <td>R$ {{number_format(DB::table('produtos')->select('valor')->where('id',$venda->produto_id)->value('valor'), 2, ',', '.')}}</td>
                                        </tr>
                                    @endforeach 
                                    </tbody> 
                                    <tr>
                                        <td><h3>R$ {{number_format($valorTotal ,2,',','.')}}</h3></td>
                                        {!! Form::model($venda, ['method'=>'POST','action'=>['VendaController@troco', $venda->id]]) !!}
                                        <td><input class="form-control" type="text" name="valor_recebido" id="valor" placeholder="Valor recebido (R$)" autofocus></td>
                                        <td>
                                            {!! Form::hidden('valorTotal', $valorTotal)!!}
                                            {!! Form::submit('FINALIZAR (Alt+C)', ['class'=>'btn btn-success','accesskey'=>'c', 'data-toggle'=>'tooltip', 'title'=>'Alt+C'])!!}
                                        </td>
                                        {!! Form::close() !!}
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
