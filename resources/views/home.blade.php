@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Lista imóveis') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(count($imoveis) >= 1)
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                               <th width="10%">Matricula</th>
                               <th width="25%">Operação</th>
                                <th width="25%">Cartorio</th>
                                <th width="10%">Cidade</th>
                                <th width="10%">UF</th>
                                <th width="25%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($imoveis as $imovel)
                            <tr>
                                <th scope="row">{{$imovel->matricula}}</th>
                                <th >{{$imovel->cliente->operacao}}</th>
                                <td>{{$imovel->cartorio}}</td>
                                <td>{{$imovel->cidade}}</td>
                                <td>{{$imovel->uf}}</td>
                                <td>

                                    @if(Auth()->user()->hasRole('admin'))
                                    <a href="{{route('documentos.imovel',[$imovel->id])}}" class="btn btn-warning btn-sm btn-block">Verificar documentos</a>
                                    @else
                                    <a href="{{route('documentos.imovel',[$imovel->id])}}" class="btn btn-success btn-sm btn-block">Envio de documentos</a>
                                    @endif




                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
