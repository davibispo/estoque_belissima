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
                background-color:thistle;
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
                    <h3 class="text-center"><b>Módulo de Venda</b></h3>
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
                                        <td><b>R$ {{number_format($valorTotal ,2,',','.')}}</b></td>
                                        <td>TROCO:</td>
                                        <td> <h3>{{$troco}}</h3> </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <p class="text-center"><a href="{{route('vendas.create')}}" class="btn btn-dark btn-sm">Vendas</a></p>
                </div>
            </div>
        </div>
    </body>
</html>
