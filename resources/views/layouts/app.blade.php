<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Estoque Belíssima</title>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <!-- Mascara -->
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color:cornflowerblue;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('img/logo.png')}}" alt="Logo" width="100" class="rounded">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest  
                        @else
                            
                            <li style="padding-right:5px"><a href="{{route('produtos.index')}}" class="btn btn-outline-dark btn-sm">Produtos</a></li> 
                            <li style="padding-right:25px" class="nav-item dropdown">
                                <a class="btn btn-outline-dark btn-sm dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Relatórios</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('relatorios.index')}}">Relatório Geral</a>
                                    <a class="dropdown-item" href="{{ route('relatorios.resumido') }}">Relatório do Dia</a>
                                    <a class="dropdown-item" href="{{ route('relatorios.periodo') }}">Relatório por Período</a>
                                </div>
                            </li> 
                            <li style="padding-right:5px"><a href="{{route('vendas.create')}}" class="btn btn-success btn-sm" accesskey="v"><b>MÓDULO VENDA (Alt+V)</b></a></li> 
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">

            <!--alertas-->
            @if (session('alertSuccess'))
                <div class="alert alert-success text-center">
                    {{ session('alertSuccess') }}
                </div>
                @elseif(session('alertDanger'))
                    <div class="alert alert-danger text-center">
                        {{ session('alertDanger') }}
                    </div>
            @endif
            <!--fim do alerta-->

            @yield('content')


            <div class="jumbotron text-center" style="margin-bottom:0; margin-top:20px">
                <p><b>Belíssima Cosméticos - Av. Pratagy nº 319b, Benedito Bentes I - Fone: (82) 98115-2999</b>
                    <br>Copyright &#174 2018-{{date('Y')}} - Todos os direitos reservados
                    <br>Desenvolvido por Davi Bispo - (82) 99969-3407
                </p>
            </div>


            <!-- Campo para busca na tabela -->
            <script>
                $(document).ready(function(){
                    $("#myInput").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#myTable tr").filter(function() {
                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                    });
                });
            </script>

            <script>
                $(document).ready(function(){
                    $('[data-toggle="tooltip"]').tooltip(); 
                });
            </script>

            <script>
                $(document).ready(function(){
                    $(".dropdown-toggle").dropdown();
                });
            </script>

        </main>
    </div>
</body>
</html>
