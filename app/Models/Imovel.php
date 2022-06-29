<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imovel extends Model

{

    protected $table = 'imoveis';
    protected $fillable = ['matricula','cidade','uf', 'client_id','cartorio','client_user_id'];

    public function cliente()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

}
