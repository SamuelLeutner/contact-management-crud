# Contact Management System

Este é um sistema de gerenciamento de contatos (CRUD) construído com Laravel 10. O foco do projeto é manter a simplicidade na interface enquanto aplica boas práticas de arquitetura e segurança no backend.

## Funcionalidades

* **Acesso Público e Privado:** Apenas a listagem de contatos é pública. Qualquer ação que altere o banco de dados (criar, editar ou excluir) exige que o usuário esteja logado.
* **Validação de Dados:** As entradas passam por regras estritas no backend:
  * O nome precisa ter mais de 5 caracteres.
  * O telefone exige exatamente 9 dígitos numéricos.
  * O e-mail deve ser único (com tratamento correto para ignorar a validação de unicidade ao editar o próprio contato).
* **Soft Deletes:** Contatos excluídos não são apagados definitivamente do banco de dados, permitindo recuperação caso necessário.
* **UI Dinâmica:** Elementos da interface (como colunas de ação e botões) são ocultados automaticamente se o visitante não estiver autenticado.

## Estrutura e Arquitetura

O código foi organizado para evitar "Fat Controllers" e manter as responsabilidades separadas:

* **Action Classes:** A lógica de persistência (Create, Update) foi isolada em classes dedicadas dentro de `app/Actions`. O controller apenas recebe a requisição e delega a execução.
* **Form Requests:** As regras de validação foram centralizadas nas classes `StoreContactRequest` e `UpdateContactRequest`.
* **Autenticação:** O fluxo de login foi implementado de forma manual utilizando as sessões nativas do Laravel, garantindo total controle sobre a proteção das rotas.

## Stack de Tecnologias

* PHP 8.1
* Laravel 10
* Blade Templates + Bootstrap 5
* MySQL

## Como Executar o Projeto

Siga os passos abaixo para rodar a aplicação em um ambiente local:

1. Instale as dependências do PHP:
```bash
composer install
```

2. Crie o arquivo de configuração de ambiente e ajuste as credenciais do seu banco de dados:
```bash
cp .env.example .env
```

3. Gere a chave de criptografia da aplicação:
```bash
php artisan key:generate
```

4. Construa o banco de dados e popule os registros iniciais (Migrations e Seeders):
```bash
php artisan migrate:fresh --seed
```

5. Inicie o servidor embutido do Laravel:
```bash
php artisan serve
```

## Seeders e Dados de Teste

Para facilitar o uso e os testes de interface, a execução do comando `--seed` mencionado acima prepara o banco de dados com:

1. **Usuário Administrador:** Necessário para acessar as operações de inclusão, edição e exclusão.
   * **Email:** admin@admin.com
   * **Senha:** 123456
2. **Contatos Fictícios:** O sistema utiliza uma Model Factory com a biblioteca Faker para gerar automaticamente 10 contatos válidos, permitindo a visualização imediata da estrutura de paginação da tabela.

## Executando os Testes

O projeto inclui testes automatizados (Feature Tests) para cobrir os cenários de sucesso e falha das validações de formulário e controle de acesso.

Para rodar a suíte de testes, execute no terminal:

```bash
php artisan test
```