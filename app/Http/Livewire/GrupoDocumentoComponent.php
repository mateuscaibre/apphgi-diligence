<?php

namespace App\Http\Livewire;

use App\Models\DocumentTypes;
use Livewire\Component;

class GrupoDocumentoComponent extends Component
{
    public $idDocumentoGrupo;
    public $idDocumento;
    public $descricao;
    public $edit = false;

    public function edit($id)
    {
        $this->limpaCampos();
        $this->edit = true;
        $this->idDocumento = $id;

        $documento = DocumentTypes::find($this->idDocumento);
        $this->descricao = $documento->descricao;
    }
    public function store()
    {
        

        if ($this->edit == false) {

            $validatedDocument = $this->validate([
                'descricao' => 'required',

            ]);

            DocumentTypes::create([
                'descricao' => $this->descricao,
                'document_id' => $this->idDocumentoGrupo

            ]);
            $this->limpaCampos();
        }

        if ($this->edit == true) {
          
            $validatedDocument = $this->validate([
                'descricao' => 'required',
            ]);

            $cliente = DocumentTypes::where('id', $this->idDocumento)
                ->update([
                    'descricao' => $this->descricao,
                    'document_id' => $this->idDocumentoGrupo
                ]);
            $this->limpaCampos();
        }
    }
    public function limpaCampos()
    {   $this->edit = false;
        $this->descricao = '';
        $this->resetValidation();
    }
    public function render()
    {
        $documentoTypes = DocumentTypes::where('document_id', $this->idDocumentoGrupo)->get();
        return view('livewire.componentes.documentos.grupo-documento-component', compact('documentoTypes'));
    }
}
