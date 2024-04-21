# ScubaPHP

ScubaPHP é um framework PHP desenvolvido como parte de um desafio de sete dias. Ele oferece um conjunto de funcionalidades para facilitar o desenvolvimento de aplicativos web, incluindo um sistema de login com validações de senha e email, bem como um sistema de troca de senha via validação por email.

## Funcionalidades

- Sistema de login seguro com validações de senha e email
- Troca de senha via validação por email
- Arquitetura flexível baseada em PSR-4 para facilitar a organização e manutenção do código
- Utilização do framework de template League Plates para renderização de views de forma eficiente
- Utilização de PSR-7 e PSR-15 para garantir interoperabilidade com outros componentes e frameworks PHP
- Injeção de dependência com PHP-DI para promover a modularidade e a testabilidade do código
- Envio de emails com PHPMailer para comunicação com os usuários de forma segura e confiável

## Requisitos

- PHP >= 7.0
- Composer (para instalação das dependências)

## Instalação

1. Copie o repositório:

```bash
git clone https://github.com/seu-usuario/scubaPHP.git
```

## Instale as dependências usando o Composer:

```bash
composer install
```

## Serviços Adicionais
O ScubaPHP também inclui os seguintes serviços adicionais:

MailService: Serviço para envio de emails com PHPMailer.
CryptService: Serviço para criptografia de dados sensíveis.
CryptToken: Serviço para geração e verificação de tokens criptografados.

## Helper para Mensagens de Erro
O ScubaPHP inclui um helper para facilitar a adição de mensagens de erro aos formulários de login e troca de senha. Esse helper utiliza a variável super global $_SESSION para armazenar e exibir as mensagens de erro.
