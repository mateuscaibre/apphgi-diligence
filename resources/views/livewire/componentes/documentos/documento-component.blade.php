<div>
    @if($listaDocumentos)
    <div class="container">
        <div class="d-flex justify-content-between">
            <h2><i class="fa fa-address-card-o" aria-hidden="true"></i> Grupos de documentos</h2>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Novo grupo de Documentos
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" wire:click="createGrupoDocumento()">Criar</a></li>
                

                </ul>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">{{ __('Alunos') }}</div> -->

                    <div class="card-body">


                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="10%">ID</th>
                                    <th width="80%">Descrição</th>
                                    <th width="20%">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documentos as $documento)
                                <tr>
                                    <th scope="row">{{$documento->id}}</th>
                                    <td>{{$documento->descricao}}</td>
                                                                     <td>
                                        <div class="dropdown show">
                                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Opções
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <button type="button" class="btn btn-link" wire:click="edit({{$documento->id}})">Editar</button>
                                        
                                            </div>
                                        </div>
                                        
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>


                    </div>
                </div>
            </div>

        </div>
    </div>
    @endif

    @if($createVisible == true)
    @include('livewire.componentes.documentos.create-documentos')
    
    @endif


</div>

