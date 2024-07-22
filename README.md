## Trello backend
Bem-vindo ao repositório back-end do Trello.


## Tecnologias usadas

- Docker e docker compose
- php: 8.0
- laravel: 8.75
- laravel passport: 10.4

## Primeiros passos

- 1- Renomeia o arquivo `.env.exmplate`  para  `.env`
- 2- Modifique o arquivo de acordo com suas necessidas
- 3- Modifique os arquivos `Dockerfile` e `docker-compose` de acordo com suas necessidas


## Suba os containers do projeto
```sh
docker-compose up -d
```

## Acessar o container app 
```sh
docker-compose exec app bash
```

## Instalar as dependências do projeto
```sh
composer install
```

## Gerar a key do projeto Laravel
```sh
php artisan key:generate
```

## Faca a migration das tabelas 
```sh
php artisan migration
```

## Gerar a key do laravel passport
```sh
php artisan passport:install
```

## Acesse a documentação completa da API
[documentação](https://documenter.getpostman.com/view/27788691/2sA3kVjM1t)


