<?php


namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\DocumentImovel;
use App\Models\Imovel;
use App\Models\Operacoes;
use App\Models\Socio;
use App\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class ClienteComponent extends Component
{
    use LivewireAlert;

    public  $listaClientes = true;
    public  $createVisible = false;
    public  $type;
    public  $time = 2000;
    public  $edit;
    public  $idCliente, $email, $nome, $operacao, $tipo_pessoa,  $cpf, $rg,  $cnpj, $rua,  $numero,  $bairro, $cidade, $uf, $cep, $possui_certificado, $numero_certificado, $usuario;


    public function getListeners()
    {
        return [
            'confirmedDestroy',
        ];
    }

    public function createCliente($type)
    {
        $this->resetValidation();
        $this->type = $type;
        $this->edit = false;
        $this->listaClientes = false;
        $this->createVisible = true;
        $this->limparCampos();
    }

    public function list()
    {

        $this->edit = false;
        $this->listaClientes = true;
        $this->createVisible = false;
    }

    public function edit($id)
    {

        $this->edit = true;
        $this->idCliente = $id;
        $this->listaClientes = false;
        $this->createVisible = true;


        if ($this->edit) {

            $cliente = Client::find($id);
            $this->type = $cliente->tipo_pessoa;
            $this->nome = $cliente->nome;
            $this->email = $cliente->email;
            $this->operacao = $cliente->operacao;
            $this->rg = $cliente->rg;
            $this->cnpj = $cliente->cnpj;
            $this->cpf = $cliente->cpf;
            $this->cep = $cliente->cep;
            $this->rua = $cliente->rua;
            $this->numero = $cliente->numero;
            $this->bairro = $cliente->bairro;
            $this->cidade = $cliente->cidade;
            $this->uf = $cliente->uf;
            $this->possui_certificado = $cliente->possui_certificado;
            $this->numero_certificado = $cliente->numero_certificado;
            $this->usuario = $cliente->usuario;
        }
    }

    public function store()
    {


        $this->resetValidation();

        if ($this->edit == false) {
            if ($this->type == 'F') {
                $validatedFisica = $this->validate([
                    'nome' => 'required',
                    'email' => 'required',
                    'cpf' => 'required',
                    'rg' => 'required',
                    'usuario' => 'required',
                ]);


                Client::create([
                    'nome' => $this->nome,
                    'email' => $this->email,
                    'operacao' => $this->operacao,
                    'tipo_pessoa' => 'F',
                    'cnpj' => null,
                    'rg' => $this->rg,
                    'cpf' => $this->cpf,
                    'cnpj' => $this->cnpj,
                    'cep' => $this->cep,
                    'rua' => $this->rua,
                    'numero' => $this->numero,
                    'bairro' => $this->bairro,
                    'cidade' => $this->cidade,
                    'uf' => $this->uf,
                    'possui_certificado' => $this->possui_certificado,
                    'numero_certificado' => $this->numero_certificado,
                    'usuario' =>  $this->usuario,
                ]);
                $this->list();
            } elseif ($this->type == 'J') {

                $validatedJuridica = $this->validate([
                    'nome' => 'required',
                    'email' => 'required',
                    'cnpj' => 'required',
                    'usuario' => 'required',
                ]);


                Client::create([
                    'nome' => $this->nome,
                    'email' => $this->email,
                    'operacao' => $this->operacao,
                    'tipo_pessoa' => 'J',
                    'cnpj' => null,
                    'rg' => null,
                    'cpf' => null,
                    'cnpj' => $this->cnpj,
                    'cep' => $this->cep,
                    'rua' => $this->rua,
                    'numero' => $this->numero,
                    'bairro' => $this->bairro,
                    'cidade' => $this->cidade,
                    'uf' => $this->uf,
                    'possui_certificado' => $this->possui_certificado,
                    'numero_certificado' => $this->numero_certificado,
                    'usuario' =>  $this->usuario
                ]);
                $this->list();
            }


            $this->alert('success', 'Registro criado com sucesso', [
                'position' => 'center',
                'timer' => $this->time,
                'toast' => false,
            ]);

            return;
        }

        if ($this->edit == true) {

            if ($this->type == 'F') {
                $validatedFisica = $this->validate([
                    'nome' => 'required',
                    'email' => 'required',
                    'cpf' => 'required',
                    'rg' => 'required',
                    'usuario' => 'required',
                ]);


                $cliente = Client::where('id', $this->idCliente)
                    ->update([
                        'nome' => $this->nome,
                        'email' => $this->email,
                        'operacao' => $this->operacao,
                        'tipo_pessoa' => 'F',
                        'cnpj' => null,
                        'rg' => $this->rg,
                        'cpf' => $this->cpf,
                        'cep' => $this->cep,
                        'rua' => $this->rua,
                        'numero' => $this->numero,
                        'bairro' => $this->bairro,
                        'cidade' => $this->cidade,
                        'possui_certificado' => $this->possui_certificado,
                        'numero_certificado' => $this->numero_certificado,
                        'usuario' => $this->usuario
                    ]);

                $this->list();
            } elseif ($this->type == 'J') {

                $validatedJuridica = $this->validate([
                    'nome' => 'required',
                    'email' => 'required',
                    'cnpj' => 'required',
                    'usuario' => 'required'
                ]);
                $cliente = Client::where('id', $this->idCliente)
                    ->update([
                        'nome' => $this->nome,
                        'email' => $this->email,
                        'operacao' => $this->operacao,
                        'tipo_pessoa' => 'J',
                        'cnpj' => $this->cnpj,
                        'rg' => null,
                        'cpf' => null,
                        'cep' => $this->cep,
                        'rua' => $this->rua,
                        'numero' => $this->numero,
                        'bairro' => $this->bairro,
                        'cidade' => $this->cidade,
                        'uf' => $this->uf,
                        'possui_certificado' => $this->possui_certificado,
                        'numero_certificado' => $this->numero_certificado,
                        'usuario' => $this->usuario
                    ]);
                $this->list();
            }

            $this->alert('success', 'Registro atualizado com sucesso', [
                'position' => 'center',
                'timer' => $this->time,
                'toast' => false,
            ]);

            return;
        }
    }

    public function limparCampos()
    {
        $this->nome = '';
        $this->email = '';
        $this->operacao_id = '';
        $this->rg = '';
        $this->cpf = '';
        $this->cnpj = '';
        $this->cep = '';
        $this->rua = '';
        $this->numero = '';
        $this->bairro = '';
        $this->cidade = '';
        $this->uf = '';
        $this->possui_certificado = '';
        $this->numero_certificado = '';
    }

    public function delete($idCliente)
    {

        $this->idCliente = $idCliente;
        $this->alert('warning', 'Tem certeza que deseja excluir esse Negócio?', [
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
    }

    public function confirmedDestroy()
    {

        try {

            Socio::destroy('client_id', $this->idCliente);
            Imovel::destroy('client_id', $this->idCliente);
            $imoveis = Imovel::where('client_id', $this->idCliente)->get();

            foreach ($imoveis as $imovel) {

                DocumentImovel::destroy('imovel_id', $imovel->id);
            }

            Client::destroy($this->idCliente);

            $this->alert('success', 'Registro excluído com sucesso', [
                'position' => 'center',
                'timer' => $this->time,
                'toast' => false,
            ]);
            $this->list();
        } catch (\Throwable $th) {
            $this->alert('warning', 'Ocorreu algum erro ao exlcuir!' . $th->getMessage(), [
                'position' => 'center',
                'timer' => $this->time,
                'toast' => false,
            ]);
        }
    }


    public function render()
    {
        $operacoes = Operacoes::all();
        $clientes = Client::all();
        $users = User::where('perfil', 3)->get();
        return view('livewire.componentes.clientes.cliente-component', compact('clientes', 'operacoes', 'users'));
    }
}
