<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ItemPedido extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'itenspedidos';

    protected $fillable = [
        'id_produto',
        'id_pedido',
        'observacao',
        'status',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }

    public function produto()
    {
        return $this->hasOne(Produto::class, 'id_produto');
    }
}

