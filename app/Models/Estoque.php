<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estoque extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    
    protected $table = 'estoque';

    protected $fillable = [
        'id_produto',
        'quantidade',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'id_pedido');
    }

}
