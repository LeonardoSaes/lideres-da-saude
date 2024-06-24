<?php 

namespace Controllers;

require_once __DIR__ . '../../../vendor/autoload.php';
require_once __DIR__ . '../../../connection.php';
require_once __DIR__ . '../../Models/PatrocinadoresModel.php';

use Table\Model\Patrocinadores;

class PatrocinadoresController
{
    public static function index(){
        return Patrocinadores::all();
    }

    public static function create($user){
        $result = Patrocinadores::create([
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
        return Patrocinadores::where('email', $email)->first();
    }

    public static function findByPhone($phone){
        return Patrocinadores::where('numero', $phone)->first();
    }

    public static function findByCPF($cpf){
        return Patrocinadores::where('cpf', $cpf)->first();

    }
}
