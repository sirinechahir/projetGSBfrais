<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formuler extends Model
{
    protected $table = 'formuler';
    public $timestamps = false;

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = ['id_medicament', 'id_presentation', 'qte_formuler'];
}
