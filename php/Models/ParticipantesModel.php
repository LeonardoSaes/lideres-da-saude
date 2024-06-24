<?php

namespace Table\Model;

use Illuminate\Database\Eloquent\Model;

class Participantes extends Model
{
    protected $table = 'participantes'; // nome da tabela no banco de dados

    // se sua tabela possui timestamps
    // public $timestamps = true;

    // se sua tabela não possui timestamps
    public $timestamps = false;

    // colunas que você deseja proteger de atribuição em massa -> getAll()
    // protected $guarded = [];

    // colunas que podem ser atribuídas em massa -> getAll()
    protected $fillable = [
        'nome', 'email', 'numero', 'cpf', 'cargo', 'sugestao'
    ];
}
