<?php

use Controllers\ParticipantesController;

// Função para validar o usuário
function validate($user) {

    $errors = [
        "name" => '',
        "email" => '',
        "cpf" => '',
        "phone" => '',
        "role" => '',
        "suggestion" => ''
    ];

    // Verifica se o nome foi preenchido
    if (empty($user['name'])) {
        $errors['name'] = "Preenchimento obrigatório.";
    }

    // Verifica se o papel foi preenchido
    if (empty($user['role'])) {
        $errors['role'] = "Preenchimento obrigatório.";
    }

    // Validação complexa do email
    if (empty($user['email'])) {
        $errors['email'] = "Preenchimento obrigatório.";
    } elseif (!isValidEmail($user['email'])) {
        $errors['email'] = "E-mail inválido.";
    } else {
        try {
            if ( ParticipantesController::findByEmail($user['email']) ) {
                $errors['email'] = "E-mail já cadastrado.";
            }
        } catch (Exception $e) {
            error_log("Erro ao verificar e-mail no banco de dados: " . $e->getMessage());
        }
    }

    // Validação do telefone
    if (empty($user['phone'])) {
        $errors['phone'] = "Preenchimento obrigatório.";
    } elseif (strlen($user['phone']) != 11 || preg_match('/(\d)\1{10}/', $user['phone']) == 1) {
        $errors['phone'] = "Número de telefone inválido.";
    } else {
        try {
            if ( ParticipantesController::findByPhone($user['phone']) ) {
                $errors['phone'] = "Telefone já cadastrado.";
            }
        } catch (Exception $e) {
            error_log("Erro ao verificar Telefone no banco de dados: " . $e->getMessage());
        }
    }

    // Validação do CPF
    if (empty($user['cpf'])) {
        $errors['cpf'] = "Preenchimento obrigatório.";
    } 
    elseif (!validCPF($user['cpf'])) {
        $errors['cpf'] = "CPF Inválido.";
    } else {
        try {
            if ( ParticipantesController::findByCPF($user['cpf']) ) {
                $errors['cpf'] = "CPF já cadastrado.";
            }
        } catch (Exception $e) {
            error_log("Erro ao verificar CPF no banco de dados: " . $e->getMessage());
        }
    }

    // Verifica se a sugestão ultrapassa o limite de caracteres
    if (!empty($user['suggestion']) && strlen($user['suggestion']) > 550) {
        $errors['suggestion'] = "Número máximo de 255 caracteres excedido.";
    }

    return $errors;
}

// Função para validar CPF
function validCpf($cpf) {
    
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

// Função para validar o formato do email
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

?>
