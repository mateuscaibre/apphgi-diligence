<div>
    <div class="container">

        <div class="row">
            <div class="form-group col-md-8 col-sm-12">
               
                <input type="text" class="form-control" placeholder="" wire:model.debounced.1000ms="descricao">
                <small class="form-text text-muted form-text-error">@error('descricao') <span
                        class="error">{{ $message }}</span> @enderror</small>
            </div>
            <div class="form-group col-md-4 col-sm-12">
                 <button class="btn btn-secondary" wire:click="store">Incluir</button>
                   
                

            </div>


        </div>
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
                                @foreach ($documentoTypes as $documento)
                                    <tr>
                                        <th scope="row">{{ $documento->id }}</th>
                                        <td>{{ $documento->descricao }}</td>
                                        <td>
                                            <button type="button" class="btn btn-link btn-sm"
                                            wire:click="edit({{ $documento->id }})">Editar</button>

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
</div>
