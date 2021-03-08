<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pedido extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'pedidos';

    protected $fillable = [
        'cliente',
        'status',
        'mesa',
        'token',
        'id_user',
    ];

    public function delivery()
    {
        return $this->hasOne(Delivery::class, 'id_pedido');
    }

    public function item()
    {
        return $this->hasMany(ItemPedido::class, 'id_pedido');
    }
}
