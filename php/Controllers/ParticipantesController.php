<?php 

namespace Controllers;

require_once __DIR__ . '../../../vendor/autoload.php';
require_once __DIR__ . '../../../connection.php';
require_once __DIR__ . '../../Models/ParticipantesModel.php';

use Table\Model\Participantes;

class ParticipantesController
{
    public static function index(){
        return Participantes::all();
    }

    // $nome, $email, $numero, $cpf, $cargo, $sugestao
    public static function create($user){

        $result = Participantes::create([
            'nome'       => $user['name'],
            'email'      => $user['email'],
            'numero'     => $user['phone'],
            'cpf'        => $user['cpf'],
            'cargo'      => $user['role'],
            'sugestao'   => $user['suggestion']
        ]);

        return $result;
    }

    public static function findByEmail($email){
        return Participantes::where('email', $email)->first();
    }

    public static function findByPhone($phone){
        return Participantes::where('numero', $phone)->first();
    }

    public static function findByCPF($cpf){
        return Participantes::where('cpf', $cpf)->first();

    }
}
