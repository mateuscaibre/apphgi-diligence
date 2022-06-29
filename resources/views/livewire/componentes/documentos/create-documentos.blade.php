<div>
    <div class="container">
        <div class="d-flex justify-content-between">
            <h2><i class="fa fa-address-card-o" aria-hidden="true"></i> Documentos: </h2>
            <button type="button" class="btn btn-link" wire:click="list">Voltar</button>

        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    

                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">Descrição</button>
                            </li>
                            @if ($edit == true)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button" role="tab"
                                    aria-controls="pills-profile" aria-selected="false">Grupo de Documentos</button>
                            </li>
                            @endif
                          
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">

                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label>Descrição:</label>
                                        <input type="text" class="form-control" placeholder=""
                                            wire:model.debounced.1000ms="descricao">
                                        <small class="form-text text-muted form-text-error">@error('descricao') <span
                                                class="error">{{ $message }}</span> @enderror</small>
                                    </div>
                                

                                </div>


                                <div class="d-flex justify-content-between">
                                    <div> <button class="btn btn-secondary"
                                            wire:click="store">{{ $edit ? 'SALVAR' : 'CRIAR NOVO' }}</button>
                                        <button type="button" class="btn btn-light" wire:click="list">CANCELAR</button>
                                    </div>
                                    @if ($edit)
                                        <div>
                                            <button class="btn btn-danger" wire:click="">EXCLUIR</button>
                                        </div>
                                    @endif
                                </div>


                            </div>
                            @if ($edit == true)
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                            
                                @livewire('grupo-documento-component', ['idDocumentoGrupo' => $idDocumento])
                                
                            </div>
                            @endif
                           
                                                         
                        </div>


                    </div>
                    <!--FIM CARD BODY-->
                </div>
            </div>

        </div>
    </div>

</div>
