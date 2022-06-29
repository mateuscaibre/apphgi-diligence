<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
        public $fillable = [
            'client_id',
            'imovel_id',
            'participant_id',
            'type_document',
            'nome',
            'cpf',
            'cnpj',
            'identidade',
            'rua',
            'numero',
            'bairro',
            'cidade',
            'uf',
            'cep',
            'estado_civil',
            'mae'
        ];

        public function participant()
        {
            return $this->belongsTo(Participant::class, 'participant_id');
        }
}
