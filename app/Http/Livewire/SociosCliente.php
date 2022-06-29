<?php

namespace App\Http\Livewire;

use App\Models\Imovel;
use App\Models\Participant;
use App\Models\Socio;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SociosCliente extends Component
{
    use LivewireAlert;

    public $socioId;
    public $nome;
    public $mae;
    public $estado_civil;
    public $identidade;
    public $cpf;
    public $cnpj;
    public $cep;
    public $rua;
    public $numero;
    public $bairro;
    public $cidade;
    public $uf;
    public $idClienteSocio;
    public $participant_id;
    public $idSocio;
    public $createSocioVisible = false;
    public $edit = false;
    public $btnNovo = true;
    public $type_document;
    public $time = 1500;

    public $imovel_id;

    public function getListeners()
    {
        return [
            'confirmedDestroy',

        ];
    }

    public function socioCreate()
    {
        $this->createSocioVisible = true;
        $this->btnNovo = false;
        $this->limparCampos();
        $this->edit = false;
    }

    protected $messages = [
        'participant_id.required' => 'Selecione um tipo de participante',
        'imovel_id.required' => 'Selecione um imóvel',
        'type_document.required' => 'Selecione um tipo de pessoa',

    ];

    public function store()
    {


        $validateSocio =  $this->validate([
            'nome' => 'required',
            'participant_id' => 'required',
            'imovel_id' => 'required',
            'type_document' => 'required',
            'mae' => '',
            'estado_civil' => '',
            'identidade' => '',
            'cpf' => '',
            'cnpj' => '',
            'cep' => '',
            'rua' => '',
            'numero' => '',
            'bairro' => '',
            'cidade' => '',
            'uf' => ''


        ]);
        if (!$this->edit) {
            #SALVA O REGISTRO NO MODO CRIAÇÃO
            Socio::create([
                'client_id' => $this->idClienteSocio,
                'imovel_id' => $this->imovel_id,
                'participant_id' => $this->participant_id,
                'nome' => $this->nome,
                'mae' => $this->mae,
                'estado_civil' => $this->estado_civil,
                'identidade' => $this->identidade,
                'cpf' => $this->cpf,
                'cnpj' => $this->cnpj,
                'cep' => $this->cep,
                'rua' => $this->rua,
                'numero' => $this->numero,
                'bairro' => $this->bairro,
                'cidade' => $this->cidade,
                'uf' => $this->uf,
                'type_document' => $this->type_document,
            ]);
            $this->alert('success', 'Registro Criado com sucesso', [
                'position' => 'center',
                'timer' => $this->time,
                'toast' => false,
            ]);
        } elseif ($this->edit) {

            $this->alert('success', 'Registro atualizado com sucesso', [
                'position' => 'center',
                'timer' => $this->time,
                'toast' => false,
            ]);
            $socio =  Socio::find($this->socioId);
            $socio->update($validateSocio);
        }
        $this->limparCampos();
        $this->createSocioVisible = false;
    }

    public function edit($id)
    {

        $this->socioId = $id;
        $this->edit = true;
        $this->createSocioVisible = true;
        $this->btnNovo = false;

        if ($this->edit) {

            $socio = Socio::find($id);

            $this->nome = $socio->nome;
            $this->mae = $socio->mae;
            $this->estado_civil = $socio->estado_civil;
            $this->identidade = $socio->identidade;
            $this->cpf = $socio->cpf;
            $this->cnpj = $socio->cnpj;
            $this->cep  = $socio->cep;
            $this->rua  = $socio->rua;
            $this->numero  = $socio->numero;
            $this->bairro  = $socio->bairro;
            $this->cidade  = $socio->cidade;
            $this->uf = $socio->uf;
            $this->participant_id = $socio->participant_id;
            $this->imovel_id = $socio->imovel_id;
            $this->type_document = $socio->type_document;


            //dd( $this->type_document);
        }
    }
    public function cancelar()
    {

        $this->limparCampos();
        $this->createSocioVisible = false;
        $this->btnNovo = true;
    }
    public function destroy($idSocio)
    {
        $this->idSocio = $idSocio;
        $this->alert('warning', 'Tem certeza que deseja excluir esse participante?', [
            'showConfirmButton' => true,
            'position' => 'center',
            'confirmButtonText' => 'Excluir',
            'onConfirmed' => 'confirmedDestroy',
            'showCancelButton' => true,
            'cancelButtonText' => 'Cancelar',
            'toast' => false,
            'allowOutsideClick' => false,
            'timer' => null,
            'confirmButtonColor' => '#d33',
            'cancelButtonColor' => '#222'
        ]);
        //Socio::destroy($idSocio);
    }
    public function confirmedDestroy()
    {

        Socio::destroy($this->idSocio);
        $this->alert('success', 'Registro excluído com sucesso', [
            'position' => 'center',
            'timer' => $this->time,
            'toast' => false,
        ]);
        $this->cancelar();
    }

    public function limparCampos()
    {

        $this->resetValidation();
        $this->nome = '';
        $this->mae = '';
        $this->estado_civil = '';
        $this->identidade = '';
        $this->documento = '';
        $this->cep  = '';
        $this->rua  = '';
        $this->numero  = '';
        $this->bairro  = '';
        $this->cidade  = '';
        $this->uf = '';
        $this->type_document = '';
        $this->participant_id = '';
        $this->imovel_id = '';
        $this->cpf = '';
        $this->cnpj = '';
    }
    public function render()
    {
        $socios = Socio::where('client_id', $this->idClienteSocio)->get();
        $imoveis = Imovel::where('client_id', $this->idClienteSocio)->get();
        $participants = Participant::all();
        return view('livewire.componentes.clientes.socios-cliente', compact('socios', 'participants', 'imoveis'));
    }
}
