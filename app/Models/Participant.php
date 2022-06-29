<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table = 'participants';
    protected $fillable = ['description'];

    public function socio()
    {
        return $this->hasMany(Socio::class);
    }
}
