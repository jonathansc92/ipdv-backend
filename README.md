# Teste

Este projeto é destinado a pôr em exercício aprendizados e conhecimento técnico simulando um cadastro de centro de custos, departamentos e usuários.

## Breifing
### Objetivo
O principal objetivo deste projeto é criar um API em Codeigniter, que possibilita.

- Cadastro de centro de custos;
- Cadastro de departamentos;
- Cadastro de usuários.

# Padrões adotados
Para criação da API foi adotado alguns padrões e conceitos para melhor legibilidade e manutenção do projeto, como:
SOLID
Design Pattern (Controllers, Models, Filters)

# Tecnologias
- API desenvolvida em Codeigniter 4
- Banco de Dados em PostgreSQL

# Pacotes
- [agungsugiarto/codeigniter4-cors](https://github.com/agungsugiarto/codeigniter4-cors)
- [https://github.com/firebase/php-jwt](https://github.com/firebase/php-jwt)

## Uso
Para rodar o projeto é necessário ter o **docker** configurador e um terminal **bash**. Após o clonar o repositório, deve ser acessada a pasta raiz do projeto e rodado o comando: `docker compose up -d` no terminal. Feito isso, só aguardar o projeto rodar e executar todos os scripts necessários. Caso desejar dados nas tabelas de banco de dados pode rodar o seeder com o comando `php artisan db:seed`. Para rodar os testes de integração, acessar o container e executar o comando `php artisan test`.

**Centro de Custos:**

Lista de centro de custow: **[GET]** `/api/cost-centers`

Mostrar um centro de custo: **[GET]** `/api/cost-centers/{id}`

Salvar um centro de custo: **[POST]** `/api/cost-centers`, payload: `{ "description": "Teste"}`

Alterar um centro de custo: **[PUT]** `/api/cost-centers/{id}`, payload: `{ "description": "Teste"}`

Excluir um centro de custo: **[DELETE]** `/api/cost-centers/{id}`

**Departamentos:**

Lista de departamentos: **[GET]** `/api/departments`

Mostrar um departamento: **[GET]** `/api/departments/{id}`

Salvar um departamento: **[POST]** `/api/departments`, payload: `{ "description": "Teste", "cost_center_id": 1}`

Alterar um departamento: **[PUT]** `/api/departments/{id}`, payload: `{ "description": "Teste", "cost_center_id": 1}`

Excluir um departamento: **[DELETE]** `/api/departments/{id}`

**Usuários:**

Lista de usuários: **[GET]** `/api/users`

Mostrar um usuário: **[GET]** `/api/users/{id}`

Salvar um usuário: **[POST]** `/api/users`, payload: `{ "name": "Teste", "password": 1, "department_id": 1, "email": "jonathan@teste.com" }`

Alterar um usuário: **[PUT]** `/api/users/{id}`, payload: `{ "name": "Teste", "password": 1, "department_id": 1, "email": "jonathan@teste.com" }`

Excluir um usuário: **[DELETE]** `/api/users/{id}`

**Login:**

Login: **[POST]** `/api/auth/login`, payload: `{ "email": "jonathan@teste.com", "password": "teste122" }`

## Autor
- Autor - Jonathan Cruz
- [https://jonathansc92.github.io/jonathancruzdev/?language=ptBr](https://jonathansc92.github.io/jonathancruzdev/?language=ptBr)