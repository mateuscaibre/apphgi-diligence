<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3><b>Envio de Documentos:</b></h3>
            </div>
            <div class="col-md-3">
                <h5>Matrícula: </h5>
            </div>
            <div class="col-md-3">
                <h5>Cidade: </h5>
            </div>
            <br>
            <br>
            <br>
            @foreach ($documentos as $doc)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><b>Matrícula - {{ $doc->descricao }} </b></div>
                        <div class="card-body">



                            <form wire:click="save">
                                <input type="file" wire:model="arquivo">

                                 @error('arquivo') <span class="error">{{ $message }}</span> @enderror

                                <button type="button">Salvar</button>
                            </form>





                        </div>
                    </div>
                    <br>
                </div>


            @endforeach
        </div>

    </div>
</div>
