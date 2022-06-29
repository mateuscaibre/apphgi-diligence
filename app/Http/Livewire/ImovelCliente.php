<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\Document;
use App\Models\DocumentImovel;
use App\Models\DocumentTypes;
use App\Models\Imovel;
use App\Models\Socio;
use Exception;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ImovelCliente extends Component
{

    use LivewireAlert;

    public $matricula;
    public $cidade;
    public $uf;
    public $idClienteImovel;
    public $idImovel;
    public $cartorio;
    public $mode;
    public $model;
    public $time = 4000;

    public function mount(Imovel $model)
    {
        $this->model = $model;
    }
    public function store()
    {

        $this->validate([
            'cartorio' => 'required',
            'cidade' => 'required',
            'uf' => 'required'
        ]);

        if ($this->mode != 'update') {

            $cliente = Client::find($this->idClienteImovel);
            Imovel::create([
                'client_user_id' => $cliente->usuario,
                'client_id' => $this->idClienteImovel,
                'matricula' => $this->matricula,
                'cartorio' => $this->cartorio,
                'cidade' => $this->cidade,
                'uf' => $this->uf,
            ]);

        } else {

            $imovel = $this->model->find($this->idImovel);

            $imovel->update([
                'matricula' => $this->matricula,
                'cartorio' => $this->cartorio,
                'cidade' => $this->cidade,
                'uf' => $this->uf,
            ]);
        }
        $this->mode = 'store';
        $this->limparCampos();
    }


    public function documents($idImovel, $parecer = false)
    {

        if ($parecer) {
            DocumentImovel::where('document_id', 1)->where('imovel_id', $idImovel)->update(['fl_ativo' => 0]);
            DocumentImovel::where('document_id', 2)->where('imovel_id', $idImovel)->update(['fl_ativo' => 0]);
            DocumentImovel::where('document_id', 3)->where('imovel_id', $idImovel)->update(['fl_ativo' => 0]);

            DocumentImovel::where('document_id', 4)->where('imovel_id', $idImovel)->update(['fl_ativo' => 1]);
            DocumentImovel::where('document_id', 5)->where('imovel_id', $idImovel)->update(['fl_ativo' => 1]);
            DocumentImovel::where('document_id', 6)->where('imovel_id', $idImovel)->update(['fl_ativo' => 1]);
        } else {
            DocumentImovel::where('document_id', 1)->where('imovel_id', $idImovel)->update(['fl_ativo' => 1]);
            DocumentImovel::where('document_id', 2)->where('imovel_id', $idImovel)->update(['fl_ativo' => 1]);
            DocumentImovel::where('document_id', 3)->where('imovel_id', $idImovel)->update(['fl_ativo' => 1]);

            DocumentImovel::where('document_id', 4)->where('imovel_id', $idImovel)->update(['fl_ativo' => 0]);
            DocumentImovel::where('document_id', 5)->where('imovel_id', $idImovel)->update(['fl_ativo' => 0]);
            DocumentImovel::where('document_id', 6)->where('imovel_id', $idImovel)->update(['fl_ativo' => 0]);
        }


        $documentosImovel = Document::find(!$parecer ? 1 : 4);
        $documentos_types = DocumentTypes::where('document_id', $documentosImovel->id)->get();
        $verificaDocumentosExistentes = DocumentImovel::where('imovel_id', $idImovel)->get();

        //dd($verificaDocumentosExistentes);

        #verifica se os documentos existem para os participantes


        $verificaParticipantes = Socio::where('imovel_id', $idImovel)->get();


        ################################ DOCUMENTOS TIPO: PESSOA FÍSICA/JURÍDICA #############################



        $documentosPJ = Document::find(!$parecer ? 2 : 5);
        $documentos_types_PJ = DocumentTypes::where('document_id', $documentosPJ->id)->get();

        $documentosPF = Document::find(!$parecer ? 3 : 6);
        $documentos_types_PF = DocumentTypes::where('document_id', $documentosPF->id)->get();



        $ids = [];

        foreach ($verificaParticipantes as $v) {

            array_push($ids, $v->id);
        }
        if (count($verificaParticipantes) > 0) {

            foreach ($ids as $id) {

                $verificaDocumentosParticipantes = DocumentImovel::where('imovel_id', $idImovel)->where('socio_id', $id)->first();
                $tipoPessoa = Socio::where('id', $id)->first();


                if (!$verificaDocumentosParticipantes && $tipoPessoa->type_document == "F") {

                    foreach ($documentos_types_PF as $document) {

                        DocumentImovel::create([
                            'imovel_id' => $idImovel,
                            'document_id' => $documentosPF->id,  // TIPO PESSOA FÍSICA, ASSOCIADO AO GRUPO 2 DE DOCUMENTOS
                            'document_type_id' => $document->id,
                            'socio_id' => $id,
                            'fl_ativo' => 1
                        ]);
                    }
                }
                if (!$verificaDocumentosParticipantes && $tipoPessoa->type_document == "J") {

                    foreach ($documentos_types_PJ as $document) {

                        DocumentImovel::create([
                            'imovel_id' => $idImovel,
                            'document_id' => $documentosPJ->id,  // TIPO PESSOA JURÍDICA, ASSOCIADO AO GRUPO 3 DE DOCUMENTOS
                            'document_type_id' => $document->id,
                            'socio_id' => $id,
                            'fl_ativo' => 1
                        ]);

                        //  dd($d);
                    }
                }
            }
            session()->flash('message', 'Tipos de documentos gerados com sucesso.');
        }

        ################################ DOCUMENTOS TIPO: PESSOA FÍSICA/JURÍDICA #############################


        if (count($verificaDocumentosExistentes) == 0) {

            foreach ($documentos_types as $document) {
                DocumentImovel::create([
                    'imovel_id' => $idImovel,
                    'document_id' => $documentosImovel->id,
                    'document_type_id' => $document->id,
                    'fl_ativo' => 1
                ]);
            }
            session()->flash('message', 'Tipos de documentos gerados com sucesso.');
        } else {
            if (count($verificaDocumentosExistentes) < count($documentos_types)) {

                $arrDocumentos = [];
                foreach ($documentos_types as $dt) {

                    array_push($arrDocumentos, $dt->id);
                }
                $arrDocumentosExistentes = [];
                foreach ($verificaDocumentosExistentes as $ex) {

                    array_push($arrDocumentosExistentes, $ex->document_type_id);
                }
                $types = array_diff($arrDocumentos, $arrDocumentosExistentes);

                foreach ($types as $document) {

                    DocumentImovel::create([
                        'imovel_id' => $idImovel,
                        'document_id' => $documentosImovel->id,
                        'document_type_id' => $document,
                        'fl_ativo' => 1

                    ]);
                }
                session()->flash('message', 'Tipos de documentos gerados com sucesso.');
            }
        }
    }
    public function destroy($idImovel)
    {

        $doc = DocumentImovel::where('imovel_id', $idImovel)->first();

        try {
            if($doc){
                throw new Exception('<b>Impossível Excluir</b>. <br> Esse imóvel está relacionado com outras partes da plataforma');
            }
        } catch (Exception $e) {
            $this->alert('warning', $e->getMessage(), [

                'position' => 'center',
                'timer' => $this->time,
                'toast' => false,
            ]);
        }

        //Imovel::destroy($idImovel);
    }
    public function edit($idImovel)
    {

        $imovel = $this->model->find($idImovel);

        $this->matricula = $imovel->matricula;
        $this->cartorio = $imovel->cartorio;
        $this->cidade =  $imovel->cidade;
        $this->uf = $imovel->uf;
        $this->idImovel = $imovel->id;

        $this->mode = "update";
    }

    public function limparCampos()
    {
        $this->matricula = '';
        $this->cartorio = '';
        $this->cidade = '';
        $this->uf = '';
    }

    public function render()
    {
        $imoveis = Imovel::where('client_id', $this->idClienteImovel)->get();
        return view('livewire.componentes.clientes.imovel-cliente', compact('imoveis'));
    }
}
