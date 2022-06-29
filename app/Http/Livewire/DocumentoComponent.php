<?php

namespace App\Http\Livewire;

use App\Models\Document;
use Livewire\Component;

class DocumentoComponent extends Component
{
    public  $listaDocumentos = true;
    public  $descricao;
    public  $idDocumento;
    public  $createVisible = false;
    public  $type;
    public  $edit;

    public function createGrupoDocumento()
    {
        $this->resetValidation();
        $this->edit = false;
        $this->listaDocumentos = false;
        $this->createVisible = true;
        $this->limparCampos();
    }

    public function edit($id)
    {
        $this->edit = true;
        $this->createVisible = true;
        $this->listaDocumentos = false;
        $this->limparCampos();
        $this->idDocumento = $id;
        $documentos = Document::find($id);
        $this->descricao = $documentos->descricao;
    }
    public function limparCampos()
    {
        $this->descricao = '';
    }
    public function list()
    {
        $this->edit = false;
        $this->listaDocumentos = true;
        $this->createVisible = false;
    }

    public function store()
    {

        $this->resetValidation();
        if ($this->edit == false) {

            $validatedDocument = $this->validate([
                'descricao' => 'required',
            ]);
            Document::create([
                'descricao' => $this->descricao,
            ]);
            $this->list();
        }

        if ($this->edit == true) {
            $validatedDocument = $this->validate([
                'descricao' => 'required',
            ]);
            $cliente = Document::where('id', $this->idDocumento)
                ->update([
                    'descricao' => $this->descricao,
                ]);
            $this->list();
        }
    }
    public function render()
    {
        $documentos = Document::all();
        return view('livewire.componentes.documentos.documento-component', compact('documentos'));
    }
}
