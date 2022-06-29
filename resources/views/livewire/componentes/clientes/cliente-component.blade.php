<div>
    @if($listaClientes)
    <div class="container">
        <div class="d-flex justify-content-between">
            <h2><i class="fa fa-address-card-o" aria-hidden="true"></i> Negócios</h2>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Novo cliente
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" wire:click="createCliente('F')">Física</a></li>
                    <li><a class="dropdown-item" wire:click="createCliente('J')">Jurídica</a></li>

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
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Pessoa</th>
                                    <th scope="col">Número do Documento</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                <tr>
                                    <th scope="row">{{$cliente->id}}</th>
                                    <th scope="row">{{$cliente->nome}}</th>
                                    <td>{{$cliente->tipo_pessoa == "F" ? "FÍSICA" : "JURÍDICA"  }}</td>
                                    <td>{{$cliente->cpf ? $cliente->cpf : $cliente->cnpj}}</td>

                                    <td>
                                        <div class="dropdown show">
                                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Opções
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <button type="button" class="btn btn-link" wire:click="edit({{$cliente->id}})">Editar</button>
                                            <button type="button" class="btn btn-link" wire:click="delete({{$cliente->id}})">Excluir</button>

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
    @include('livewire.componentes.clientes.create-cliente')

    @endif


</div>

