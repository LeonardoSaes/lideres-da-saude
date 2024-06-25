<?php

function checkOrigin() {
    // Defina os domínios permitidos
    $allowed_domains = [
        'https://lideresdasaude.com',
    ];

    // Verifique se o cabeçalho HTTP_ORIGIN está presente
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        $origin = $_SERVER['HTTP_ORIGIN'];
        if (!in_array($origin, $allowed_domains)) {
            header('HTTP/1.1 403 Forbidden');
            echo 'Forbidden: Access is denied.';
            exit();
        }
    } else {
        // Alternativamente, você pode verificar o HTTP_REFERER se HTTP_ORIGIN não estiver presente
        if (isset($_SERVER['HTTP_REFERER'])) {
            $referer = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
            $referer_scheme = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_SCHEME);
            $full_referer = $referer_scheme . '://' . $referer;
            if (!in_array($full_referer, $allowed_domains)) {
                header('HTTP/1.1 403 Forbidden');
                echo 'Forbidden: Access is denied.';
                exit();
            }
        } else {
            header('HTTP/1.1 403 Forbidden');
            echo 'Forbidden: Access is denied.';
            exit();
        }
    }
}