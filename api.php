<?php

require "vendor/autoload.php";
require "Auth.php";

function autenticar($usuario, $senha): ?string {
    $token = Auth::authenticate($usuario, $senha);
    if (!$token) {
        echo "Credenciais inválidas";
        return null;
    }
    return $token;
}

function listUsers($usuario, $senha): ?array {
    $token = autenticar($usuario, $senha);
    if (!$token) {
        return null;
    }
    $data = Auth::validate($token);
    if (!$data) {
        return null;
    }

    if(!in_array('admin', $data->sub->roles)) {
        echo "Acesso negado. Somente para Administradores";
        return null;
    }
    $users = json_decode(file_get_contents("users.json"), true);
    return $users;
}

if($argc != 3){
    echo "Você deve informar usuário e senha";
    return;
}

$username = $argv[1];
$password = $argv[2] ?? null;
$users = listUsers($username, $password);
if(!$users){
    return;
}
foreach($users as $user){
    print_r($user);
}
