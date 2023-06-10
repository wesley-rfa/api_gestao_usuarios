<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurante extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'restaurantes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'nome_restaurante',
        'hora_abertura',
        'hora_fechamento',
        'descricao',
        'telefone',
        'email',
        'senha',
        'imagem',
        'cep',
        'rua',
        'numero',
        'complemento',
        'ponto_referencia',
        'estado',
        'cidade',
        'especialidade',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $hidden = [
        'senha',
        'deleted_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function pratos()
    {
        return $this->hasMany(Prato::class, 'restaurante_id', 'id');
    }
}
