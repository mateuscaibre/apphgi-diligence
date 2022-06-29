<div>
    <div class="row justify-content-center">
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group  col-md-2 col-sm-12">
                            <input type="text" class="form-control" placeholder="MATRICULA"
                                wire:model.debounced.1500ms="matricula">
                            <small class="form-text text-muted form-text-error">
                                @error('matricula')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group  col-md-10 col-sm-12">
                            <input type="text" class="form-control" placeholder="CARTORIO"
                                wire:model.debounced.1500ms="cartorio">
                            <small class="form-text text-muted form-text-error">
                                @error('cartorio')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group  col-md-6 col-sm-12">
                            <input type="text" class="form-control" placeholder="CIDADE"
                                wire:model.debounced.1500ms="cidade">
                            <small class="form-text text-muted form-text-error">
                                @error('cidade')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group  col-md-4 col-sm-12">

                            <input type="text" class="form-control" placeholder="UF" wire:model.debounced.1500ms="uf">
                            <small class="form-text text-muted form-text-error">
                                @error('uf')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </small>
                        </div>
                        <div class="form-group  col-md-2 col-sm-12">
                            <button class="btn btn-secondary btn-block" wire:click="store()">

                                @if ($mode == 'update')
                                    Salvar
                                @else
                                    Incluir
                                @endif
                            </button>
                        </div>
                    </div>
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="10%">Matricula</th>
                            <th width="15%">Cartorio</th>
                            <th width="15%">Cidade</th>
                            <th width="10%">UF</th>
                            <th width="50%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($imoveis as $imovel)
                            <tr>
                                <th scope="row">{{ $imovel->matricula }}</th>
                                <td>{{ $imovel->cartorio }}</td>
                                <td>{{ $imovel->cidade }}</td>
                                <td>{{ $imovel->uf }}</td>
                                <td>

                                    <button class="btn btn-primary btn-sm"
                                        wire:click.prevent="edit({{ $imovel->id }})">Editar</button>

                                    <button class="btn btn-danger btn-sm"
                                        wire:click.prevent="destroy({{ $imovel->id }})">Excluir</button>

                                    <button class="btn btn-primary btn-sm"
                                        wire:click.prevent="documents({{ $imovel->id }})">Solicitar
                                        Documentos</button>
                                    <button class="btn btn-success btn-sm"
                                        wire:click.prevent="documents({{ $imovel->id }},true)">Solicitar
                                        Parecer</button>

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
