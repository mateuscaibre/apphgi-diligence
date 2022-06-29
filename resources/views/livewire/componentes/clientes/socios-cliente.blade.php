<div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">


                <div class="card-body">
                    <div class="row">
                        <div class="form-group  col-md-12 col-sm-12">
                            <!-- Button trigger modal -->
                            @if ($btnNovo == true)
                                <button type="button" class="btn btn-primary" wire:click.prevent="socioCreate">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Novo participante
                                </button>
                            @endif

                            @if ($createSocioVisible == true)
                                @include('livewire.componentes.clientes.socios-modal')

                            @endif
                        </div>
                    </div>

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
                                        <button class="btn btn-primary btn-sm"
                                            wire:click.prevent="edit({{ $socio->id }})"><i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                        <button class="btn btn-danger btn-sm"
                                            wire:click.prevent="destroy({{ $socio->id }})"><i
                                                class="fa fa-times-circle" aria-hidden="true"></i></button>
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
