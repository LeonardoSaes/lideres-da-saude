<?php

require_once __DIR__ . '../../Middleware/middleware.php';
checkOrigin();

header('Content-Type: application/json');

require_once __DIR__ . '../../Controllers/ParticipantesController.php';
require_once __DIR__ . '../../Controllers/EmailController.php';
require_once __DIR__ . '../../Validators/ParticipantesValidator.php';

use Controllers\ParticipantesController;
use Controllers\EmailController;

// Pega os valores enviados na requisição

$name       = ( isset($_POST['name']) )       ? $_POST['name']       : '';
$email      = ( isset($_POST['email']) )      ? $_POST['email']      : '';
$cpf        = ( isset($_POST['cpf']) )        ? $_POST['cpf']        : '';
$phone      = ( isset($_POST['phone']) )      ? $_POST['phone']      : '';
$role       = ( isset($_POST['role']) )       ? $_POST['role']       : '';
$suggestion = ( isset($_POST['suggestion']) ) ? $_POST['suggestion'] : NULL;

$user = [
    'name'       => strtolower($name),
    'email'      => strtolower($email),
    'cpf'        => preg_replace("/[^0-9]/", "", $cpf),
    'phone'      => preg_replace("/[^0-9]/", "", $phone),
    'role'       => strtolower($role),
    'suggestion' => (!empty($suggestion)) ? strtolower($suggestion) : NULL,
];

// Chama os validadores de dados

$erros = validate($user); 

foreach ($erros as $campo => $mensagem) {
    if (!empty($mensagem)) {
        $json = [
            'status' => 'error',
            'erros'  => $erros
        ];
        echo json_encode($json);
        die();
    }
}

$resultInsert = ParticipantesController::create($user);

if( $resultInsert ) { 

    $mail = new EmailController();
    $mail->sendParticipantEmail($user);
    
    $json = [
        'status' => 'success',
        'erros'  => $erros
    ];
    echo json_encode($json);
    die();
}

echo json_encode(['index' => 'ERRO NO SERVIDOR.']);

