@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3><b>Envio de Documentos:</b></h3>
            </div>
                       <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="20%">Matricula</th>
                            <th width="20%">Cartorio</th>
                            <th width="20%">Cidade</th>
                            <th width="20%">Estado</th>

                            <th width="20%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>{{ $imovel->matricula }}</td>
                            <td>{{ $imovel->cartorio }}</td>
                            <td>{{ $imovel->cidade }}</td>
                            <td>{{ $imovel->estado }}</td>
                            <td>
                                <a href="{{ route('documentos.imovel.send', [$imovel->id]) }}"
                                    class="btn btn-warning btn-sm btn-block">Ver documentos</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="20%">Nome do Participante</th>
                            <th width="20%">Cargo</th>
                            <th width="20%">Tipo Pessoa</th>

                            <th width="15%">Documento</th>
                            <th width="20%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($socios as $socio)
                            <tr>
                                <td>{{ $socio->nome }}</td>
                                <td>{{ $socio->participant->description }}</td>

                                <td>{{ $socio->type_document == 'F' ? 'FÍSICA' : 'JURÍDICA' }}</td>
                                <td>{{ $socio->type_document == 'F' ? $socio->cpf : $socio->cnpj }}</td>
                                <td>
                                    <a href="{{ route('documentos.imovel.socio.send', [$imovel->id, $socio->id]) }}"
                                        class="btn btn-warning btn-sm btn-block">Ver documentos</a>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

        </div>

    </div>



@endsection
