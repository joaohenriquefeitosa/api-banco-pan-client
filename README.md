# api-banco-pan-client

[![CircleCI](https://circleci.com/gh/bevicred/api-banco-pan-client/tree/master.svg?style=svg)](https://circleci.com/gh/bevicred/api-banco-pan-client/tree/master) [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Client para integração com a API Consignado do Banco PAN.

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
$result = $client->meioLiberacao("{codigo_convenio}", "{tipo_operacao}", "{cep_cliente}", "{valor_cliente}");
```

### Orgãos
Consulta os orgãos disponiveis para um determinado convenio.
```php
$result = $client->orgaos("{codigo_convenio}");
```

### Proposta
Retorna a lista de simulações.
```php
$result = $client->simularProposta("{codigo_usuario}",
                                   "{codigo_filial}",
                                   "{codigo_supervisor}",
                                   "{codigo_promotora}",
                                   "{codigo_convenio}",
                                   "{cpf_cliente}",
                                   "{matricula_preferencial_cliente}",
                                   "{matricula_complementar_cliente}",
                                   "{data_nascimento_cliente}",
                                   "{renda_mensal_cliente}",
                                   "{valor_simulacao}",
                                   "{metodo_simulacao}",
                                   "{prazo_simulacao}",
                                   "{despesas_simulacao}",
                                   "{operacoes_refinanciamento}",
                                   "{tipo_operacao}");
```

### Usuários
Retorna a lista dos usernames existentes para um determinado CPF do usuário digitador.
```php
$result = $client->usuarios("{cpf}");
```