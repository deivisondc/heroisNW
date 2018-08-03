# Heróis NW

Sistema desenvolvido como desafio técnico para o processo de seleção da New Way.

### Pré Requisitos

```
PHP
Composer
MySQL
```

### Instalação

```
1) Clonar este repositório
2) Rodar o comando "composer install"
3) Rodar o comando "php artisan key:generate"
4) Criar um banco de dados
5) Configurar o arquivo .env com os dados referentes ao banco
6) Rodar o comando "php artisan migrate" para criar as tabelas no banco de dados
7) Rodar o comando "php artisan db:seed" para alimentar as tabelas do banco com alguns dados iniciais
8) Rodar o comando "php artisan storage:link" para criar um link simbólico no Storage e deixar os arquivos 
   visíveis para a web.
9) Rodar o comando "php artisan passport:install" para instalar o Passport (autorização OAuth2 para a API). 
   Isso vai retornar um resultado parecido com o seguinte

	Personal access client created successfully.
	Client ID: 1
	Client Secret: boIzBix2ERI0RDeRjgCYYZEW08qxV37fzhCpwlvt
	Password grant client created successfully.
	Client ID: 2
	Client Secret: iFeIHsNcqhRySXerfwOpTmWH5iXtQiKAJfsoBRbc

	Guarde esse retorno em um bloco de notas para ser usado para a autenticação na API.

```

### Servidor

Para subir o servidor utilize o comando "php artisan serve"
A URL padrão do sistema é http://localhost:8000, e com o seed já foi criado um usuário para logar no sistema:

```
E-mail: teste@teste.com.br
Senha: 123456
```

Caso não queira utilizar este usuário, pode registrar um novo no botão superior direito da tela.

### API

Para a utilização da API é necessário passar pela autenticação OAuth2 provida pelo Laravel Passport. 
Para isto, siga os seguintes passos

```
1) Utilizando o Postman, fazer um requisição POST para a URL http://<url-que-esta-rodando-o-sistema>/oauth/token 
   com os seguintes parâmetros no BODY
	
	grant_type: password
	client_id: 2
	client_secret: iFeIHsNcqhRySXerfwOpTmWH5iXtQiKAJfsoBRbc
	username: teste@teste.com.br
	password: 123456

	Obs: os valores do client_id e client_secret são aqueles do passo da Instalação, que foi pedido para guardar 
	na etapa 9) da Instalação. Caso tenha perdido, rodar o comando "php artisan passport:keys --force" para gerar 
	novas chaves. Já o username e password são dados que foram inseridos no banco (seed) como um usuário para 
	teste do sistema.

2) Ao enviar essa requisição, receberá uma resposta contendo as informações que serão usadas para autenticar. 
   Essa resposta é semelhante à seguinte:

	{
	    "token_type": "Bearer",
	    "expires_in": 31536000,
	    "access_token": "eyJ0eXAiOiJKV1Qi[...]",
	    "refresh_token": "def50200ed53b23[...]"
	}


3) Com esses dados, já é possível utilizar a API, basta que para cada requisição feita, seja colocado no HEADER os 
   seguintes parâmetros:

	Accept: application/json
	Authorization: <token_type> <access_token>

	Obs: substitua o <token_type> e o <access_token> pelos valores correspondentes recebidos na etapa 2).

```

### Ferramentas utilizadas

* [Laravel](https://laravel.com/) - Framework PHP
* [Postman](https://www.getpostman.com/) - Testes de API
* [GitHub Desktop](https://desktop.github.com/) - Controle de Versão e hospedagem 

## Autor

* **Deivison Cardoso** - [GitHub](https://github.com/deivisondc)