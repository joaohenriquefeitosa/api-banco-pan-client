# api-banco-pan-client

[![CircleCI](https://circleci.com/gh/bevicred/api-banco-pan-client/tree/master.svg?style=svg)](https://circleci.com/gh/bevicred/api-banco-pan-client/tree/master) [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Client para integração com a API do banco PAN.

## Instalação

A instalação é via [composer](https://getcomposer.org). Siga as [instruções de instalação](https://getcomposer.org/doc/00-intro.md) se você não tiver o composer instalado.
Uma vez instalado o composer, execute o seguinte comando na raiz do seu projeto para instalar esta biblioteca:

```sh
composer require bevicred-digital/api-banco-pan-client
```
## Exemplo de utilização
### Autenticação
```php
$client = new Client("{Api-Key}");  
$client->authenticate("{username}", "{password}");
```
### Convênios
Retorna uma lista com os convênios habilitados.
```php
$result = $client->covenants("{codigo_promotora}");
```

