<?php

require 'Auth.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $headers = getallheaders();
    $token = $headers['Authorization'] ?? null;

    if ($token) {
        $decoded = Auth::validate($token);

        if ($decoded) {
            if (!in_array('admin', $decoded->sub->roles)) {
                http_response_code(403);
                echo json_encode(['status' => 'unauthorized', 'message' => 'Usuário logado não é administrador.']);
                return;
            }
            $users = json_decode(file_get_contents('users.json'));
            http_response_code(200);
            echo json_encode(['status' => 'success', 'data' => $users]);
            //nl2br("Nome: " .  $user->nome . '\nEmail: ' . $user->email . "\nUsername: " .  $user->username . "\nRoles: " . implode(", ", $user->roles));
            return;
        } else {
            http_response_code(401);
            echo json_encode(['status' => 'error', 'message' => 'Token inválido ou expirado']);
            return;
        }

    } else {
        http_response_code(401);
        echo json_encode(['status' => 'error', 'message' => 'Token não fornecido']);
        return;
    }
}
