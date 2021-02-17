<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Despesa extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'despesas';

    protected $fillable = [
        'descricao',
        'valor',
        'data',
    ];
}
