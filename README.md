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
$client->autenticacao("{username}", "{password}");
```
### Convênios
Retorna uma lista com os convênios habilitados.
```php
$result = $client->convenios("{codigo_promotora}");
```
### Filiais
Retorna a lista de filiais e sua promotora relacionada os quais o usuário está habilitado a realizar operações.
```php
$result = $client->filiais();
```

### Meio de Liberação
Consulta os meios de liberação disponíveis.
```php
$result = $client->meio_liberacao("{codigo_convenio}", "{tipo_operacao}", "{cep_cliente}", "{valor_cliente}");
```
