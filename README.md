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
- [https://github.com/agungsugiarto/codeigniter4-cors](agungsugiarto/codeigniter4-cors)
- [https://github.com/firebase/php-jwt](https://github.com/firebase/php-jwt)

## Uso
Para rodar o projeto é necessário ter o **docker** configurador e um terminal **bash**. Após o clonar o repositório, deve ser acessada a pasta raiz do projeto e rodado o comando: `docker compose up -d` no terminal. Feito isso, só aguardar o projeto rodar e executar todos os scripts necessários. Caso desejar dados nas tabelas de banco de dados pode rodar o seeder com o comando `php artisan db:seed`. Para rodar os testes de integração, acessar o container e executar o comando `php artisan test`.

**TESTE DE Suportes balanceados:**
Suporte Balanceados: **[POST]** `/api/check-balanced/`, payload: `{ "sequence": "{sequence}" }`.

**PERSONS:**

Lista de pessoas: **[GET]** `/api/persons`.

Mostrar uma pessoa: **[GET]** `/api/persons/1`.

Salvar uma pessoa: **[POST]** `/api/persons`, payload: `{ "name": "{name}" }`.

Alterar uma pessoa: **[PUT]** `/api/persons/1`, payload: `{ "name": "{name}" }`.

Excluir uma pessoa: **[DELETE]** `/api/persons/1`.

**CONTACTS:**

Salvar um contato: **[POST]** `/api/contacts`, payload: `{ "phone": "{phone}", "whatsapp": "{whatsapp}", "email": "{email}", "person_id": {1} }`.

Alterar uma pessoa: **[PUT]** `/api/contacts/1`, , payload: `{ "phone": "{phone}", "whatsapp": "{whatsapp}", "email": "{email}", "person_id": {1} }`.

Excluir uma pessoa: **[DELETE]** `/api/contacts/1`.

Por fim, é isso.
Qualquer dúvida, ou sugestão. Enviar e-mail para: jonathansc92@gmail.com