<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Entrada extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'entradas';

    protected $fillable = [
        'id_pedido',
        'total',
        'pago',
        'liquido',
        'juros',
        'id_formapagamento',
    ];
}
