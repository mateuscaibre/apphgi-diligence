<div>
    <div class="container">
        <div class="d-flex justify-content-between">
            <h2><i class="fa fa-address-card-o" aria-hidden="true"></i> Negócio: {{ $nome }} </h2>
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
                                    aria-selected="true">Dados do Cliente</button>
                            </li>
                            @if ($edit == true)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">Participantes do
                                        contrato</button>
                                </li>
                            @endif
                            @if ($edit == true)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Imóveis</button>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">

                                <div class="row">
                                    <div class="form-group col-md-2 col-sm-12">
                                        <label>Operação:</label>
                                        <input type="text" class="form-control" placeholder=""
                                            wire:model.debounced.1000ms="operacao">
                                        <small class="form-text text-muted form-text-error">@error('operacao') <span
                                                class="error">{{ $message }}</span> @enderror</small>
                                    </div>

                                    <div class="form-group col-md-5 col-sm-12">
                                        <label>Nome:</label>
                                        <input type="text" class="form-control" placeholder=""
                                            wire:model.debounced.1000ms="nome">
                                        <small class="form-text text-muted form-text-error">@error('nome') <span
                                                class="error">{{ $message }}</span> @enderror</small>
                                    </div>
                                    <div class="form-group col-md-5 col-sm-12">
                                        <label>Email:</label>
                                        <input type="text" class="form-control" placeholder=""
                                            wire:model.debounced.1000ms="email">
                                        <small class="form-text text-muted form-text-error">@error('email') <span
                                                class="error">{{ $message }}</span> @enderror</small>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group  col-md-12 col-sm-12">
                                        <label for="exampleFormControlSelect2">Usuário:</label>
                                        <select class="form-control" name="usuario"
                                            wire:model.debounced.1000ms="usuario">

                                            <option value="" >Selecione um cliente/usuário</option>
                                            @foreach ($users as $user)
                                                <option value={{ $user->id }} {{count($users) == 1 ? 'selected' : ''}}> {{ $user->id }} # {{ $user->name }} - {{ $user->email }}</option>
                                            @endforeach

                                        </select>
                                        <small class="form-text text-muted form-text-error">@error('usuario') <span
                                          class="error">{{ $message }}</span> @enderror</small>
                                    </div>
                                </div>

                                <div class="row">
                                    @if ($type == 'F')
                                        <div class="form-group  col-md-6 col-sm-12">
                                            <label>RG:</label>
                                            <input type="text" class="form-control" placeholder=""
                                                wire:model.debounced.1000ms="rg">
                                            <small class="form-text text-muted form-text-error">@error('rg') <span
                                                    class="error">{{ $message }}</span> @enderror</small>
                                        </div>
                                        <div class="form-group  col-md-6 col-sm-12">
                                            <label>CPF:</label>
                                            <input type="text" class="form-control" placeholder=""
                                                wire:model.debounced.1000ms="cpf">
                                            <small class="form-text text-muted form-text-error">@error('cpf') <span
                                                    class="error">{{ $message }}</span> @enderror</small>
                                        </div>
                                    @elseif($type == 'J')
                                        <div class="form-group  col-md-12 col-sm-12">
                                            <label>CNPJ:</label>
                                            <input type="text" class="form-control" placeholder=""
                                                wire:model.debounced.1000ms="cnpj">
                                            <small class="form-text text-muted form-text-error">@error('cnpj') <span
                                                    class="error">{{ $message }}</span> @enderror</small>
                                        </div>
                                    @endif
                                </div>


                                <div class="row">
                                    <div class="form-group  col-md-2 col-sm-12">
                                        <label>CEP:</label>
                                        <input type="text" class="form-control" placeholder=""
                                            wire:model.debounced.1000ms="cep">
                                        <small class="form-text text-muted form-text-error">@error('cep') <span
                                                class="error">{{ $message }}</span> @enderror</small>
                                    </div>
                                    <div class="form-group  col-md-8 col-sm-12">
                                        <label>RUA:</label>
                                        <input type="text" class="form-control" placeholder=""
                                            wire:model.debounced.1000ms="rua">
                                        <small class="form-text text-muted form-text-error">@error('rua') <span
                                                class="error">{{ $message }}</span> @enderror</small>
                                    </div>
                                    <div class="form-group  col-md-2 col-sm-12">
                                        <label>Nº:</label>
                                        <input type="text" class="form-control" placeholder=""
                                            wire:model.debounced.1000ms="numero">
                                        <small class="form-text text-muted form-text-error">@error('numero') <span
                                                class="error">{{ $message }}</span> @enderror</small>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="form-group  col-md-4 col-sm-12">
                                        <label>BAIRRO:</label>
                                        <input type="text" class="form-control" placeholder=""
                                            wire:model.debounced.1000ms="bairro">
                                        <small class="form-text text-muted form-text-error">@error('bairro') <span
                                                class="error">{{ $message }}</span> @enderror</small>
                                    </div>
                                    <div class="form-group  col-md-4 col-sm-12">
                                        <label>CIDADE:</label>
                                        <input type="text" class="form-control" placeholder=""
                                            wire:model.debounced.1000ms="cidade">
                                        <small class="form-text text-muted form-text-error">@error('cidade') <span
                                                class="error">{{ $message }}</span> @enderror</small>
                                    </div>
                                    <div class="form-group  col-md-4 col-sm-12">
                                        <label>ESTADO:</label>
                                        <input type="text" class="form-control" placeholder=""
                                            wire:model.debounced.1000ms="uf">
                                        <small class="form-text text-muted form-text-error">@error('uf') <span
                                                class="error">{{ $message }}</span> @enderror</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group  col-md-3 col-sm-12">


                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember" wire:model.debounced.1000ms="possui_certificado">

                                            <label class="form-check-label" for="remember">
                                                POSSUI CERTIFICADO?
                                            </label>
                                            <small
                                                class="form-text text-muted form-text-error">@error('possui_certificado')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror</small>
                                        </div>
                                    </div>
                                    @if ($possui_certificado)
                                        <div class="form-group  col-md-9 col-sm-12">
                                            <label>NÚMERO DO CERTIFICADO:</label>
                                            <input type="text" class="form-control" placeholder=""
                                                wire:model.debounced.1000ms="numero_certificado">
                                            <small
                                                class="form-text text-muted form-text-error">@error('numero_certificado')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror</small>
                                        </div>
                                    @endif
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

                                <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                    aria-labelledby="pills-profile-tab">

                                    @livewire('socios-cliente', ['idClienteSocio' => $idCliente])
                                </div>

                            @if ($edit == true)
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab">

                                    @livewire('imovel-cliente', ['idClienteImovel' => $idCliente])
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
