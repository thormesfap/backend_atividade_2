<?php

require "vendor/autoload.php";
require "Auth.php";

use GuzzleHttp\Client;

$user = $argv[1] ?? 'nao_informado';
$pass = $argv[2] ?? 'nao_informado';

$token = Auth::authenticate($user, $pass);

$client = new Client();

try{

    $response = $client->request("GET", "http://localhost:8000/api.php", [
        "headers" => [
            "Authorization" => $token
        ]
    ]);

    echo $response->getBody();

}catch (\Throwable $e){
    echo "Erro: ".$e->getMessage();
}