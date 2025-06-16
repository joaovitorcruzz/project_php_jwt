# Projeto de API REST com Autenticação JWT e Níveis de Acesso

## 🎯 Objetivo

Este projeto foi desenvolvido como parte da avaliação da disciplina de Programação Orientada a Objetos (POO). O objetivo é demonstrar a construção de uma API RESTful segura utilizando o framework **Laravel (PHP)**, implementando autenticação baseada em JSON Web Tokens (JWT) e controle de acesso por papéis (Roles).

A aplicação simula um sistema onde existem dois tipos de usuários:
* **User**: Usuário comum, com permissão para gerenciar apenas seu próprio perfil.
* **Admin**: Usuário administrador, com permissões elevadas para gerenciar todos os usuários do sistema.

## ✨ Funcionalidades Principais

* **Cadastro de Usuários**: Rota pública para registro de novos usuários, com a possibilidade de definir um papel (`user` ou `admin`).
* **Autenticação com JWT**: Geração de um token de acesso no login, necessário para acessar rotas protegidas.
* **Controle de Acesso por Papel (RBAC)**: Middlewares que garantem que apenas usuários com o papel correto possam acessar determinados endpoints.
* **Gerenciamento de Perfil**: Usuários autenticados podem visualizar e editar seus próprios dados.
* **Gerenciamento de Usuários (Admin)**: Administradores podem listar, visualizar, editar e deletar qualquer usuário do sistema.

## 🛠️ Tecnologias Utilizadas

* **PHP 8.2+**
* **Laravel 11**
* **Composer** (Gerenciador de Dependências)
* **Tymon/jwt-auth** (Para implementação do JWT)
* **SQlite** (ou qualquer banco de dados relacional suportado pelo Laravel)
* **Insomnia** (Para testes da API)

## 🚀 Como Rodar o Projeto Localmente

Siga os passos abaixo para configurar e executar a aplicação em seu ambiente de desenvolvimento.

### Pré-requisitos
* [PHP](https://www.php.net/downloads.php) (versão 8.2 ou superior)
* [Composer](https://getcomposer.org/)
* Um servidor de banco de dados relacional (ex: MySQL, MariaDB, PostgreSQL) ou o utilizado (SQlite)

### Passos de Instalação

1.  **Clone o repositório:**
    ```bash
    git clone [https://github.com/joaovitorcruzz/project_php_jwt.git](https://github.com/joaovitorcruzz/project_php_jwt.git)
    cd seu-repositorio
    ```

2.  **Instale as dependências do PHP:**
    ```bash
    composer install
    ```

3.  **Crie o arquivo de ambiente:**
    * Copie o arquivo de exemplo `.env.example` para um novo arquivo chamado `.env`.
    ```bash
    cp .env.example .env
    ```

4.  **Configure o Banco de Dados no arquivo `.env`:**
    * Abra o arquivo `.env` e atualize as variáveis de banco de dados com suas credenciais.
    ```ini
    DB_CONNECTION=sqlite
    # DB_HOST=127.0.0.1
    # DB_PORT=3306
    # DB_DATABASE=laravel
    # DB_USERNAME=root
    # DB_PASSWORD=
    ```

5.  **Gere a chave da aplicação:**
    ```bash
    php artisan key:generate
    ```

6.  **Gere o segredo do JWT:**
    ```bash
    php artisan jwt:secret
    ```

7.  **Execute as Migrations:**
    * Este comando criará as tabelas no banco de dados, incluindo a tabela `users`.
    ```bash
    php artisan migrate
    ```

8.  **Inicie o servidor local:**
    ```bash
    php artisan serve
    ```
    * A API estará disponível em `http://127.0.0.1:8000`.

## 📖 Endpoints da API

Aqui está a lista de rotas disponíveis na API.

| Método | Endpoint               | Descrição                                         | Autenticação   |
| :----- | :--------------------- | :------------------------------------------------ | :------------- |
| `POST` | `/api/register`        | Registra um novo usuário (pode incluir `role`).   |  Pública      |
| `POST` | `/api/login`           | Autentica um usuário e retorna um token JWT.      | Pública      |
| `GET`  | `/api/profile`         | Retorna os dados do usuário autenticado.          | **Requerida** |
| `PUT`  | `/api/profile`         | Atualiza os dados do usuário autenticado.         | **Requerida** |
| `GET`  | `/api/users`           | Lista todos os usuários do sistema.               | **Admin** |
| `PUT`  | `/api/users/{id}`      | Atualiza os dados de um usuário específico.       | **Admin** |
| `DELETE`| `/api/users/{id}`     | Deleta um usuário específico.                     | **Admin** |

**Nota:** Para todas as rotas com autenticação **Requerida** ou **Admin**, é necessário enviar o token de acesso no cabeçalho `Authorization` como `Bearer [seu_token]`.

## 📂 Arquivos Complementares (Insomnia)

Para facilitar a avaliação e os testes dos endpoints, disponibilizei uma coleção de requisições prontas para o Insomnia, bem como prints de todas as rotas em funcionamento.

Você pode acessar os materiais no link abaixo:

➡️ **[Acessar Arquivos no Google Drive](https://drive.google.com/drive/folders/19EkOpgVMgJ4Kk2qJTjaNDYhsWEQ7X5yE?usp=sharing)**

No link, você encontrará:
* O arquivo de exportação do Insomnia para importação direta.
* Screenshots de cada requisição (cadastro, login, acesso autorizado, acesso negado, etc.).


* Para importar o arquivo do Insomnia, basta abrir o mesmo, criar um novo projeto, dentro do mesmo, clique em import, e selecione o respectivo arquivo anexado.
---
*Desenvolvido por joaovitorcruzz*