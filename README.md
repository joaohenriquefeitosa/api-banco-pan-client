# api-banco-pan-client

[![CircleCI](https://circleci.com/gh/bevicred/api-banco-pan-client/tree/master.svg?style=svg)](https://circleci.com/gh/bevicred/api-banco-pan-client/tree/master) 
[![Maintainability](https://api.codeclimate.com/v1/badges/864b0ebccd07bd925893/maintainability)](https://codeclimate.com/github/bevicred/api-banco-pan-client/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/864b0ebccd07bd925893/test_coverage)](https://codeclimate.com/github/bevicred/api-banco-pan-client/test_coverage)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

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
$client = new Client("{apiKey}", "{baseUrlApi}");  
$client->authenticate("{username}", "{password}");
```
### Convênios
Retorna uma lista com os convênios habilitados.
```php
$result = $client->covenants("{codigo_promotora}");
```
### Filiais
Retorna a lista de filiais e sua promotora relacionada os quais o usuário está habilitado a realizar operações.
```php
$result = $client->institutionalAffiliates();
```

### Meio de Liberação
Consulta os meios de liberação disponíveis.
```php
$result = $client->releaseMedium("{codigo_convenio}", "{tipo_operacao}", "{cep_cliente}", "{valor_cliente}");
```

### Orgãos
Consulta os orgãos disponiveis para um determinado convenio.
```php
$result = $client->institutionalBodies("{codigo_convenio}");
```

### Proposta
Retorna a lista de simulações.
```php
$result = $client->simulateProposal("{codigo_usuario}",
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
$result = $client->users("{cpf}");
```