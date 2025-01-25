Projeto simples para teste de geração de token JWT e sua validação

## Instruções de Uso

Inicialmente, execute o comando a seguir para instalar as bibliotecas necessárias:
```
composer install
```

Os usuários válidos e suas respectivas credenciais de exemplo estão no arquivo `users.json`

Para utilizar o script, execute o comando
```
php api.php 'username' 'password'
```

O script deve validar as credenciais do usuário e listar todos os usuários, caso o usuário que esteja autenticando tenha papel de administrador