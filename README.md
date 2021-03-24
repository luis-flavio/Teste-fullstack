# Controle de Fornecedores

Pequeno sistema para cadastrar fornecedores de uma empresa com controles e validações tanto para pessoa física quanto pessoa jurídica.

## Destaques

- Arquitetura MVC
- Back-end todo trabalhado com rotas e OO
- Utilização das bibliotecas CoffeeCode Router [https://packagist.org/packages/coffeecode/router] e DataLayer [https://packagist.org/packages/coffeecode/datalayer] para trabalhar com as rotas e * tratar e manipular o uso do banco de dados de forma simples e segura
- PHP Standard Recommendation

## Instalação

Descompacte os arquivos dentro de um servidor apache e importe o banco de dados.

O banco de dados vem configurado para se utilizar o MySQL de forma local na porta padrão 3306. Caso o banco de dados a ser utilizado para esse sistema estiver em outro local ou ser outro, basta mudar as configurações no arquivo Config.php dentro da pasta app, ele e totalmente compatível aos drivers disponíveis pela extensão PDO.

Todos os componentes e dependências estão disponíveis dentro da pasta vendor.