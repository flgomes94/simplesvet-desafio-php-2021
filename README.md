# Desafio Simplesvet 2021
## Vaga Desenvolvedor PHP: Desafio 2021

O objetivo do projeto era desenvolver uma ferramenta de importação de uma solução complicada para uma solução simples, a simplesvet.
O projeto é composto pelos módullos:

- Banco de Dados (database)
- Script de exportação (script)
- Backend de importação (backend)
- Frontend de importação (frontend)

## Considerações Gerais de Código

- para emular os dois bancos de dados, foi utilizada a tecnologia docker;
- para o script, utilizado tecnologia php, com mysqli;
- Para o frontend, utilizado Vue.JS, HTML, CSS, Javascript;
- para o backend, utilizado composer e HTML;
- ATENÇÃO: AO IMPORTAR UMA BASE DE DADOS COM ELEMENTOS REPETIDOS, OU COM IDS JÁ INSERIDOS NO BANCO DE DADOS, OS INSERTS COM ID JÁ INSERIDOS NÃO SERÃO CADASTRADOS NO BANCO

## Instalação

### Banco de dados

O projeto requer [PHP](https://www.php.net) > 7 (utilizado PHP 7.4) com extensão de banco de dados [mysqli](https://www.php.net/manual/pt_BR/book.mysqli.php) habilitada. Além disso é utilizado [Docker](https://www.docker.com), [VueJS](https://vuejs.org) e [npm](https://www.npmjs.com)

Inicie o banco de dados

```sh
cd database
docker-compose up --build -d
```

Existe uma interface gráfica para verificaçao do banco de daods. Ela pode ser acessada por http://127.0.0.1:8080. 

| Chave | Valor |
| ------ | ------ |
| Sistema | MySQL |
| Servidor | db |
| Usuário | root |
| Senha | root |
| Base de dados |  |

### Script

Para fazer exportação dos dados, utilize os seguintes comandos:

```sh
cd script
php script.php
```

Os arquivos Animal.csv e Cliente.csv estão na raiz da pasta script

### Backend

Para executar o backend do projeto, execute os seguintes comandos:

```sh
cd backend
php -S 127.0.0.1:8000 -t src/public
```

> Se desejar, a porta pode ser alterada, porém, será necessário efetuar a troca no arquivo .env do frontend

### Frontend

Por fim, para executar o frontend do projeto, execute os seguintes comandos:
```sh
cd frontend
npm install
npm run serve
```

`O frontend estará disponível no link em que o Vue informar.`

## License

MIT

