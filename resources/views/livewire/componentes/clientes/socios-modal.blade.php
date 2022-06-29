<div class="modal-body">
    <div class="row">
        <div class="form-group  col-md-6 col-sm-12">
            <label for="exampleFormControlSelect2">Cargo do participante no contrato? </label>
            <select class="form-control" id="exampleFormControlSelect2" name="participant_id"
                wire:model.debounced.1000ms="participant_id">
                <option value="" selected disabled>Selecione um tipo de participante</option>
                @foreach ($participants as $participant)
                    <option value={{ $participant->id }}>{{ $participant->description }}</option>
                @endforeach

            </select>
            <small class="form-text text-muted form-text-error">@error('participant_id') <span
                class="error">{{ $message }}</span> @enderror</small>
        </div>
        <div class="form-group  col-md-6 col-sm-12">
            <label for="exampleFormControlSelect2">Tipo de Pessoa: </label>
            <select class="form-control" name="type_document"
                wire:model.debounced.1000ms="type_document">

                <option value="" selected disabled>Selecione um tipo de pessoa</option>
                <option value="F">Física</option>
                <option value="J">Jurídica</option>


            </select>
            <small class="form-text text-muted form-text-error">@error('type_document') <span
                class="error">{{ $message }}</span> @enderror</small>
        </div>
        <div class="form-group  col-md-12 col-sm-12">

            <input id="nome" type="text" class="form-control" placeholder="Nome/Razão"
                wire:model.debounced.1000ms="nome">
            <small class="form-text text-muted form-text-error">@error('nome') <span
                    class="error">{{ $message }}</span> @enderror</small>
        </div>
        @if ($type_document == 'F')
            <div class="form-group  col-md-6 col-sm-12">

                <input type="text" class="form-control" placeholder="Nome da mae" wire:model.debounced.1000ms="mae">
                <small class="form-text text-muted form-text-error">@error('mae') <span
                        class="error">{{ $message }}</span> @enderror</small>
            </div>
            <div class="form-group  col-md-6 col-sm-12">

                <select class="form-control" style="width: 100%" wire:model.debounced.500ms="estado_civil">
                    <option value="" selected disabled>Estado Civil</option>
                    <option value="Casado">Casado(a)</option>
                    <option value="Solteiro(a)">Solteiro(a)</option>
                    <option value="Divorciado(a)">Divorciado(a)</option>
                    <option value="Viúvo(a)">Viúvo(a)</option>

                </select>
                <small class="form-text text-muted form-text-error">@error('estado_civil') <span
                        class="error">{{ $message }}</span> @enderror</small>
            </div>



            <div class="form-group  col-md-6 col-sm-12">

                <input type="text" class="form-control" placeholder="Identidade"
                    wire:model.debounced.1000ms="identidade">
                <small class="form-text text-muted form-text-error">@error('identidade') <span
                        class="error">{{ $message }}</span> @enderror</small>
            </div>

            <div class="form-group  col-md-6 col-sm-12">

                <input type="text" class="form-control" placeholder="CPF"
                    wire:model.debounced.1000ms="cpf">
                <small class="form-text text-muted form-text-error">@error('cpf') <span
                        class="error">{{ $message }}</span> @enderror</small>
            </div>
        @else

            <div class="form-group  col-md-12 col-sm-12">

                <input type="text" class="form-control" placeholder="CNPJ" wire:model.debounced.1000ms="cnpj">
                <small class="form-text text-muted form-text-error">@error('CNPJ') <span
                        class="error">{{ $message }}</span> @enderror</small>
            </div>

        @endif



    </div>
    <div class="row">

        <div class="form-group  col-md-2 col-sm-12">

            <input type="text" class="form-control" placeholder="CEP" wire:model.debounced.1000ms="cep">
            <small class="form-text text-muted form-text-error">@error('cep') <span
                    class="error">{{ $message }}</span> @enderror</small>
        </div>
        <div class="form-group  col-md-6 col-sm-12">

            <input type="text" class="form-control" placeholder="Rua" wire:model.debounced.1000ms="rua">
            <small class="form-text text-muted form-text-error">@error('rua') <span
                    class="error">{{ $message }}</span> @enderror</small>
        </div>
        <div class="form-group  col-md-4 col-sm-12">

            <input type="text" class="form-control" placeholder="Numero" wire:model.debounced.1000ms="numero">
            <small class="form-text text-muted form-text-error">@error('numero') <span
                    class="error">{{ $message }}</span> @enderror</small>
        </div>
        <div class="form-group  col-md-4 col-sm-12">

            <input type="text" class="form-control" placeholder="Bairro" wire:model.debounced.1000ms="bairro">
            <small class="form-text text-muted form-text-error">@error('bairro') <span
                    class="error">{{ $message }}</span> @enderror</small>
        </div>
        <div class="form-group  col-md-4 col-sm-12">

            <input type="text" class="form-control" placeholder="Cidade" wire:model.debounced.1000ms="cidade">
            <small class="form-text text-muted form-text-error">@error('cidade') <span
                    class="error">{{ $message }}</span> @enderror</small>
        </div>
        <div class="form-group  col-md-4 col-sm-12">

            <input type="text" class="form-control" placeholder="UF" wire:model.debounced.1000ms="uf">
            <small class="form-text text-muted form-text-error">@error('uf') <span
                    class="error">{{ $message }}</span> @enderror</small>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Qual imóvel o participante pertence? </label>
            <select class="form-control" id="exampleFormControlSelect2" name="imovel_id"
                wire:model.debounced.1000ms="imovel_id">

                <option value=""></option>
                @foreach ($imoveis as $imovel)
                    <option value={{ $imovel->id }} {{count($imoveis) == 1 ? 'selected' : ''}}>Matrícula: {{ $imovel->matricula }} - Cartório:{{ $imovel->cartorio }}</option>
                @endforeach

            </select>
            <small class="form-text text-muted form-text-error">@error('imovel_id') <span
              class="error">{{ $message }}</span> @enderror</small>

        </div>

    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" wire:click="cancelar()">Cancelar</button>
    <button class="btn btn-secondary" wire:click="store()">Salvar</button>
</div>
</div>
