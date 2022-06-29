@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3><b>Envio de Documentos:</b></h3>
            </div>
            <div class="col-md-3">
                <h5>Matrícula: {{$imovel->matricula}} </h5>
            </div>
            <div class="col-md-3">
                <h5>Cidade: {{$imovel->cidade}} </h5>
            </div>
            <br>
            <br>
            <br>
            <form action="{{ route('documentos.imovel.upload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="idImovel" value={{ $idImovel }}>
                <input type="hidden" name="idDocumento"  value={{ $idDocumento }}>
                <input type="hidden" name="idSocio"  value={{ $idSocio }}>
                <input type="file" name="documento">
                <input type="submit" value="Enviar">
            </form>
        </div>

    </div>

    {{-- <livewire:upload-documento/> --}}

@endsection
