@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-body">
                    
                    <div class="container-fluid" style="background-color:khaki;">
                        <div class="row">
                          <!-- Tela de Comprovante -->
                            <div class="col-sm-12 tela-venda" style="background-color:khaki; overflow:auto; ">
                                <p class="text-center">COMPROVANTE NÃO FISCAL</p> 

                                <table class="table" style="padding:0px">
                                    <thead>
                                        <tr>
                                            <th>Código Prod.</th>
                                            <th>Produto</th>
                                            <th>R$</th>
                                        </tr>
                                    </thead>
                                    @foreach ($vendas as $item)
                                        @foreach ($produtos as $p)
                                            @if ($item->produto_id == $p->id)  
                                            <tr>
                                                <td> {{$p->codigo}} </td>
                                                <td> {{$p->descricao}} </td>
                                                <td> {{$item->preco}} </td>
                                            </tr>                
                                            @endif
                                        @endforeach
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

