## Teste para Desenvolvedor PHP/Laravel

Bem-vindo ao teste de desenvolvimento para a posição de Desenvolvedor PHP/Laravel. 

O objetivo deste teste é desenvolver uma API Rest para o cadastro de fornecedores, permitindo a busca por CNPJ ou CPF, utilizando Laravel no backend.

## Descrição do Projeto

Este projeto utiliza **Laravel** em um ambiente **Docker** com **PHP**, **Nginx** e **MySQL**. Siga as instruções abaixo para configurar e executar a aplicação corretamente.

---

### 🚀 Configuração Inicial

#### 1️⃣ Subindo o ambiente Docker
Certifique-se de ter o **Docker** e **Docker Compose** instalados. Para iniciar os serviços, execute:

```sh
docker-compose up -d
```
Isso iniciará os contêineres do PHP, Nginx e MySQL em background.

#### 2️⃣ Configuração de permissões
Após subir os serviços, execute o seguinte comando para garantir as permissões corretas das pastas **storage** e **bootstrap/cache**:

```sh
docker exec -it php8.3-dev chmod -R 775 storage bootstrap/cache
```

Se houver erro de permissão, altere para o usuário do Docker (`www-data`) (opcional):

```sh
docker exec -it php8.3-dev chown -R www-data:www-data storage bootstrap/cache
```

#### 3️⃣ Configuração do ambiente Laravel
Dentro do contêiner PHP, execute os seguintes comandos:

```sh
# Acesse o container
docker exec -it php8.3-dev bash

# Instale as dependências do Laravel
composer install

# Copie o arquivo de exemplo do ambiente
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate

# Execute as migrations e seeders (se necessário)
php artisan migrate --seed
```

---

### 🛠️ Executando a Aplicação

Agora, a aplicação Laravel está configurada e rodando. Para acessá-la:

- **Frontend (Nginx/Laravel):** [`http://localhost`](http://localhost)
- **Banco de Dados (MySQL):**
    - Host: `localhost` ou o ip do docker `172.17.0.1`
    - Usuário: `root`
    - Senha: `root`
    - Porta: `3306`

Para acessar os logs:
```sh
docker exec -it php8.3-dev tail -f storage/logs/laravel.log
```
---

### 🔍 Testando a Aplicação

Para rodar os testes:
```sh
docker exec -it php8.3-dev php artisan test
```

---

### 🛑 Parando e Removendo o Ambiente

Para parar os contêineres:
```sh
docker-compose down
```

Para remover volumes (atenção: isso apagará os dados do banco!):
```sh
docker-compose down -v
```

---

### 📌 Observações
- Caso precise acessar os serviços manualmente, utilize `docker exec -it php8.3-dev bash` para entrar no contêiner.
- Modifique `php8.3-dev` conforme definido no `docker-compose.yml`.

Agora, sua aplicação está pronta para teste! 🚀


### Backend (API Laravel):
As rotas estão disponíves para testar na pasta `workspace`. Basta acessá-la e executar as rotas.

#### CRUD de Fornecedores:
- **Criar Fornecedor:**
  - Permita o cadastro de fornecedores usando CNPJ ou CPF, incluindo informações como nome/nome da empresa, contato, endereço, etc.
  - Valide a integridade e o formato dos dados, como o formato correto de CNPJ/CPF e a obrigatoriedade de campos.

- **Editar Fornecedor:**
  - Facilite a atualização das informações de fornecedores, mantendo a validação dos dados.

- **Excluir Fornecedor:**
  - Possibilite a remoção segura de fornecedores.

- **Listar Fornecedores:**
  - Apresente uma lista paginada de fornecedores, com filtragem e ordenação.

#### Migrations:
- Utilize migrations do Laravel para definir a estrutura do banco de dados, garantindo uma boa organização e facilidade de manutenção.

## Requisitos

### Backend:
- Implementar busca por CNPJ na [BrasilAPI](https://brasilapi.com.br/docs#tag/CNPJ/paths/~1cnpj~1v1~1{cnpj}/get) ou qualquer outro endpoint público.

## Tecnologias a serem utilizadas
- Framework Laravel (PHP) 9.x ou superior
- MySQL ou Postgres

## Critérios de Avaliação
- Adesão aos requisitos funcionais e técnicos.
- Qualidade do código, incluindo organização, padrões de desenvolvimento e segurança.
- Documentação do projeto, incluindo um README detalhado com instruções de instalação e operação.

## Bônus
- Implementação de Repository Pattern.
- Implementação de testes automatizados.
- Dockerização do ambiente de desenvolvimento.
- Implementação de cache para otimizar o desempenho.

## Entrega
- Para iniciar o teste, faça um fork deste repositório; Se você apenas clonar o repositório não vai conseguir fazer push.
- Crie uma branch com o nome que desejar;
- Altere o arquivo README.md com as informações necessárias para executar o seu teste (comandos, migrations, seeds, etc);
- Depois de finalizado, envie-nos o pull request;


