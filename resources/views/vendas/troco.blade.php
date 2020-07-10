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

            .btn-dark{
                background-color: #1b3054ff;
            }
            .btn-primary{
                background-color: #3e6dc3ff;
            }
            
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h3 class="text-center"><b style="color: white; background-color: #1b3054ff; border-radius: 20px; padding:0px 10px 0px 10px;">Módulo de Venda</b></h3>
                    <p>Funcionário: {{ auth()->user()->name }}</p>
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <b>Total da compra: R$ {{number_format($valorTotal ,2,',','.')}} </b><hr>
                                <b>Valor recebido: R$ {{number_format($recebido ,2,',','.')}} </b><hr>
                                <h2>TROCO: <b>R$ {{number_format($troco ,2,',','.')}}</b> </h2>
                            </div>
                        </div>
                    </div>
                    <div style="padding-top:10px;">
                        <p class="text-center"><a href="{{route('vendas.create')}}" class="btn btn-dark btn-sm" accesskey="v" data-toggle="tooltip" title="ALT + v">Vendas (Alt+V)</a></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
