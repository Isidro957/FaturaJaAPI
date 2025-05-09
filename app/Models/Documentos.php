<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{

    protected $table = 'documentos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'org_id',
        'titulo_doc',
        'arquivo_doc',
    ];
    protected $guarded = [];
}
