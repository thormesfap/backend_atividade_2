<?php

require 'vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

class Auth
{
    private static string $secretKey = 'ch4v3_s3cr3t4';

    private static function generateJWT(array $data): string
    {
        global $secretKey;

        $issuedAt = time();
        $expirationTime = $issuedAt + 3600; // Token válido por 1 hora

        $payload = [
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'sub' => $data
        ];

        return JWT::encode($payload, self::$secretKey, 'HS256');
    }

    public static function validate(string $token): ?stdClass
    {
        try {
            return JWT::decode($token, new Key(self::$secretKey, 'HS256'));
        } catch (ExpiredException $e) {
            echo json_encode(['error' => 'Token expirado']);
            return null;
        } catch (SignatureInvalidException $e) {
            echo json_encode(['error' => 'Token inválido']);
            return null;
        } catch (Exception $e) {
            echo json_encode(['error' => 'Erro ao validar o token']);
            return null;
        }
    }

    public static function authenticate($username, $password): ?string
    {
        $users = json_decode(file_get_contents('users.json'));
        foreach ($users as $user) {
            if ($user->username == $username && $user->password == $password) {
                return self::generateJWT(['name' => $user->name ?? '', 'username' => $user->username ?? '' , 'roles' => $user->roles ?? [], 'email' => $user->email ?? '']);
            }
        }
        return null;
    }
}




