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
        'recebido',
        'id_formapagamento',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }

    public function forma()
    {
        return $this->belongsTo(FormaPagamento::class, 'id_formapagamento')->withTrashed();
    }
}
