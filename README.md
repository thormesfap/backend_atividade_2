Projeto simples para teste de geração de token JWT e sua validação

## Instruções de Uso

Inicialmente, execute o comando a seguir para instalar as bibliotecas necessárias:
```
composer install
```

Os usuários válidos e suas respectivas credenciais de exemplo estão no arquivo `users.json`

Antes de utilizar o script, suba o servidor para receber requisições para api com o comando

```
php -S 0.0.0.0:8000 -t api.php
```

Para utilizar o script, execute o comando
```
php index.php 'username' 'password'
```

O script deve validar as credenciais do usuário e listar todos os usuários, caso o usuário que esteja autenticando tenha papel de administrador