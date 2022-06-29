@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3><b>Envio de Documentos:</b></h3>
            </div>
            <div class="col-md-3">
                <h5>Matrícula: {{ $imovel->matricula }} </h5>
            </div>
            <div class="col-md-3">
                <h5>Cidade: {{ $imovel->cidade }} </h5>
            </div>
            <br>

            @if ($socio)
                <div class="col-md-12">
                    <hr>

                    <p><b>{{ $socio->participant->description }}: </b>{{ $socio->nome }}</p>
                    <hr>
                </div>
            @endif



            @if (Auth()->user()->hasRole('cliente') || $gestor == false)
                @foreach ($documentos as $doc)
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"><b>{{ $doc->document_type_id }} - {{ $doc->descricao }} </b>
                            </div>
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-2">
                                        @if ($doc->file == false)
                                            @if ($doc->socio_id)
                                                <a href="{{ route('documentos.imovel.upload.item.socio', [Request::segment(3), $doc->id, Request::segment(4)]) }}"
                                                    class="btn btn-primary btn-block">anexar</a>
                                            @else
                                                <a href="{{ route('documentos.imovel.upload.item.imovel', [Request::segment(3), $doc->id]) }}"
                                                    class="btn btn-primary btn-block">anexar</a>
                                            @endif
                                        @else
                                            @if ($doc->status_documento == 'A ENVIAR' || $doc->status_documento == 'REJEITADO')
                                                <a href="{{ route('documentos.imovel.upload.item.delete', [Request::segment(3), $doc->id]) }}"
                                                    class="btn btn-danger btn-block">Cancelar</a>
                                            @endif
                                        @endif

                                    </div>
                                    <div class="col-md-2">
                                        @if ($doc->file)
                                            <a href="{{ asset('storage/' . $doc->file) }}">{{ $doc->id }}-
                                                Documento</a>
                                            {{-- @if ($doc->status_documento == 'REJEITADO')
                                                <span class="badge badge-danger"><b>Status:
                                                        {{ $doc->status_documento }}</b></span>
                                            @endif --}}
                                            @if ($doc->status_documento == 'EM ANALISE')
                                                <span class="badge badge-warning"><b>Status:
                                                        {{ $doc->status_documento }}</b></span>
                                            @endif

                                            @if ($doc->status_documento == 'APROVADO')
                                                <span class="badge badge-success"><b>Status:
                                                        {{ $doc->status_documento }}</b></span>
                                            @endif
                                        @else
                                            @if ($doc->status_documento == 'A ENVIAR')
                                                <span class="badge badge-default"><b>Status:
                                                        {{ $doc->status_documento }}</b></span>
                                            @endif
                                        @endif

                                    </div>
                                    <div class="col-md-8">
                                        @if ($doc->observacao)
                                            <div class="col">
                                                <h5>Última observação: <em>{{ $doc->observacao }}</em></h5>
                                                <hr>

                                            </div>
                                        @endif

                                        @if ($doc->file && $doc->status_documento === 'A ENVIAR')
                                            <a href="{{ route('documentos.imovel.item.send', [$doc->cd]) }}"
                                                class="btn btn-primary btn-block">ENVIAR DOCUMENTO</a>
                                        @endif

                                        @if ($doc->status_documento === 'REJEITADO' || $doc->aprovado === 0)
                                            <span class="badge badge-danger"><b>Status:
                                                    {{ $doc->status_documento }}</b></span>
                                        @endif

                                        @if ($doc->status_documento === 'EM ANALISE')
                                            <button disabled="disabled" class="btn btn-warning btn-block">Nossa equipe
                                                está revisando o documento.</button>
                                        @endif

                                    </div>
                                </div>

                            </div>
                        </div>
                        <br>
                    </div>
                @endforeach
            @else
                @foreach ($documentos as $doc)
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header"><b>{{ $doc->document_type_id }} - {{ $doc->descricao }} </b>
                            </div>
                            <div class="card-body">

                                <div class="row">


                                    <div class="col-md-12">

                                        @if ($doc->file && $doc->status_documento == 'EM ANALISE')
                                            <a href="{{ asset('storage/' . $doc->file) }}"" class="

                                                btn btn-warning btn-block">{{ $doc->id }}-
                                                Baixar Documento em {{ $doc->status_documento }}</a>
                                        @endif

                                        @if ($doc->file && $doc->status_documento == 'APROVADO')
                                            <a href="{{ asset('storage/' . $doc->file) }}"
                                                class="

                                                btn btn-success btn-block">{{ $doc->id }}-
                                                Baixar Documento em {{ $doc->status_documento }}</a>
                                        @endif
                                        @if ($doc->file && $doc->aprovado === 0 && $doc->status_documento == 'REJEITADO')
                                            <a href="{{ asset('storage/' . $doc->file) }}"
                                                class="

                                                btn btn-danger btn-block">{{ $doc->id }}-
                                                Baixar Documento em {{ $doc->status_documento }}</a>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    @if ($doc->observacao)
                                        <div class="col">
                                            <h5>Última observação: <em>{{ $doc->observacao }}</em></h5>
                                            <hr>

                                        </div>
                                    @endif


                                    @if ($doc->file && $doc->status_documento == 'EM ANALISE' && $doc->aprovado != 1)
                                        <div class="">
                                            <form action="{{ route('documentos.imovel.item.send.status') }}"
                                                method="post">
                                                @csrf
                                                <input type="hidden" class="form-control" name="idDocumento"
                                                    value={{ $doc->cd }}>
                                                <div class="col-md-12">

                                                    <div class="form-group">
                                                        <label for="">Observação</label>
                                                        <input type="text" class="form-control" name="observacao"
                                                            placeholder="Digite uma observação">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label for="">Status</label>
                                                        <select class=" form-control" name="status_documento">
                                                            <option value=""></option>
                                                            <option value="REJEITADO">REJEITADO</option>
                                                            <option value="APROVADO">APROVADO</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn-block">Mudar Status</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endif

                                </div>


                            </div>
                        </div>
                        <br>
                    </div>
                @endforeach
            @endif

        </div>
        <button onclick="window.print()">Imprimir página</button>
    </div>

    {{-- <livewire:upload-documento/> --}}

@endsection
