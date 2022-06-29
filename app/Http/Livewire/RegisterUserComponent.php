<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class RegisterUserComponent extends Component
{
    use LivewireAlert;

    public $nome;
    public $email;
    public $password;
    public $cpf;
    public $idUser;
    public $users;
    public $mode = 'create';
    public $time = 2500;

    //'cpf' => 'required|numeric|min:13|unique:alunos,cpf,' . $this->idAluno ,
    protected $rules = [];

    public function rules()
    {
        return [
            'nome' => 'required|min:6',
            'email' => 'required|email|unique:users,email,' . $this->idUser,
            'cpf' => 'required|cpf|unique:users,cpf,' . $this->idUser,

        ];
    }

    protected $messages = [
        'cpf.required' => 'O campo CPF/CNPJ é obrigatório.',
        'cpf.cpf_ou_cnpj' => 'Tipo de CPF é inválido',
        'cpf.unique' => 'Este CPF já está vinculado a outro cliente',
        'cpf.cpf' => 'Formato do CPF inválido',
    ];

    public function getListeners()
    {
        return [
            'confirmedDestroy',

        ];
    }
    public function store()
    {


        $this->validate();

        if ($this->mode == 'create') {
            User::create([
                'name' => $this->nome,
                'email' => $this->email,
                'password' => Hash::make($this->cpf),
                'cpf' => $this->cpf,
                'perfil' => 3
            ]);

            $this->alert('success', 'Registro Criado com sucesso', [
                'position' => 'center',
                'timer' => $this->time,
                'toast' => false,
            ]);

            $this->limpa();
            $this->lista();
        }
        if ($this->mode == 'edit') {
            $user = User::find($this->idUser);
            $user->update([
                'name' => $this->nome,
                'email' => $this->email,
                'cpf' => $this->cpf,
            ]);

            $this->alert('success', 'Registro atualizado com sucesso', [
                'position' => 'center',
                'timer' => $this->time,
                'toast' => false,
            ]);
            $this->limpa();
            $this->lista();
        }
    }

    public function save()
    {
    }
    public function create()
    {
        $this->mode == 'create';
        $this->limpa();
        $this->resetValidation();
    }

    public function edit($id)
    {

        $this->mode = 'edit';
        $this->resetValidation();
        $user = User::find($id);
        $this->idUser = $id;
        $this->nome = $user->name;
        $this->email =  $user->email;
        $this->cpf = $user->cpf;
    }
    public function destroy($id)
    {

        $this->idUser = $id;
        $this->alert('warning', 'Deseja excluir esse usuário?', [
            'showConfirmButton' => true,
            'position' => 'center',
            'confirmButtonText' => 'Excluir',
            'onConfirmed' => 'confirmedDestroy',
            //'input' => 'password',
            'showCancelButton' => true,
            'cancelButtonText' => 'Cancelar',
            'toast' => false,
            'allowOutsideClick' => false,
            'timer' => null,
            'confirmButtonColor' => '#d33',
            'cancelButtonColor' => '#222'
        ]);
    }

    public function lista()
    {
        $this->users = User::where('perfil', 3)->get();
    }
    public function limpa()
    {
        $this->nome = '';
        $this->email = '';
        $this->cpf = '';
        $this->mode = 'create';
    }

    public function confirmedDestroy()
    {

        $verificaCliente = Client::where('usuario', $this->idUser )->first();
        if($verificaCliente){
            $this->alert('warning', 'Este cliente está relacionado com um Negócio, verifique', [
                'position' => 'center',
                'timer' => $this->time,
                'toast' => false,
            ]);
            return;
        }
        User::destroy($this->idUser);

        $this->limpa();
        $this->lista();

        $this->alert('success', 'Registro excluído com sucesso', [
            'position' => 'center',
            'timer' => $this->time,
            'toast' => false,
        ]);
    }
    public function render()
    {

        $this->lista();
        return view('livewire.register-user-component');
    }
}
