<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $fillable = [

        'nome',
        'operacao',
        'tipo_pessoa',
        'cnpj',
        'rg' ,
        'cpf' ,
        'cep' ,
        'rua' ,
        'numero',
        'bairro',
        'cidade',
        'uf',
        'possui_certificado',
        'numero_certificado',
        'email',
        'usuario',
    ];

    public function imovel()
    {
        return $this->hasMany("App\Models\Imovel");
    }
}
