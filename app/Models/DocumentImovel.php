<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentImovel extends Model
{
    protected $fillable = ['imovel_id', 'document_id', 'document_type_id', 'file', 'status_documento','aprovado', 'observacao', 'file_old','socio_id','fl_ativo'];
}
