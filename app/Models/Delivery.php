<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Delivery extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'delivery';

    protected $fillable = [
        'endereco',
        'observacao',
        'status',
        'id_user',
        'id_pedido',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }

}
