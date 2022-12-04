<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Llibre extends Model
{
    use HasFactory;

    protected $casts=[
        'dataP' => 'datetime:Y-m-d'
    ];

    public function autor()
    {
        return $this->belongsTo(Autor::class);
    }
}
