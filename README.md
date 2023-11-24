![](https://heatbadger.now.sh/github/readme/contributte/apitte-skeleton/)

<p align=center>
  <a href="https://github.com/contributte/apitte-skeleton/actions"><img src="https://badgen.net/github/checks/contributte/apitte-skeleton/master"></a>
  <a href="https://coveralls.io/r/contributte/apitte-skeleton"><img src="https://badgen.net/coveralls/c/github/contributte/apitte-skeleton"></a>
  <a href="https://packagist.org/packages/contributte/apitte-skeleton"><img src="https://badgen.net/packagist/dm/contributte/apitte-skeleton"></a>
  <a href="https://packagist.org/packages/contributte/apitte-skeleton"><img src="https://badgen.net/packagist/v/contributte/apitte-skeleton"></a>
</p>
<p align=center>
  <a href="https://packagist.org/packages/contributte/apitte-skeleton"><img src="https://badgen.net/packagist/php/contributte/apitte-skeleton"></a>
  <a href="https://github.com/contributte/apitte-skeleton"><img src="https://badgen.net/github/license/contributte/apitte-skeleton"></a>
  <a href="https://bit.ly/ctteg"><img src="https://badgen.net/badge/support/gitter/cyan"></a>
  <a href="https://bit.ly/cttfo"><img src="https://badgen.net/badge/support/forum/yellow"></a>
  <a href="https://contributte.org/partners.html"><img src="https://badgen.net/badge/sponsor/donations/F96854"></a>
</p>

<p align=center>
Website 🚀 <a href="https://contributte.org">contributte.org</a> | Contact 👨🏻‍💻 <a href="https://f3l1x.io">f3l1x.io</a> | Twitter 🐦 <a href="https://twitter.com/contributte">@contributte</a>
</p>

<p align=center>
    <img src="https://api.microlink.io?url=https%3A%2F%2Fexamples.contributte.org%2Fapitte-skeleton%2F&overlay.browser=light&screenshot=true&meta=false&embed=screenshot.url"></img>
</p>

-----

## Goal

Main goal is to provide best prepared API starter-kit project for Nette-Apitte developers.

Focused on:

- PHP 8.1+
- `nette/*` packages
- build PSR-7 API via `contributte/apitte`
- Doctrine ORM via `nettrine/*`
- Symfony components via `contributte/*`
- codestyle checking via **CodeSniffer** and `contributte/qa`
- static analysing via **phpstan** and `contributte/phpstan`
- unit / integration tests via **Nette Tester** and `contributte/tester`

You can try it out yourself either by running it with docker, or more easily with docker-compose.

## Demo

https://examples.contributte.org/apitte-skeleton/

## Install with [docker](https://github.com/docker/docker/)

1) At first, use composer to install this project.

   ```bash
   composer create-project -s dev contributte/apitte-skeleton
   ```

2) After that, you have to setup database.

    1. Setup PostgreSQL 10. You can start it manually or use docker image `dockette/postgres:15`.

       ```bash
       docker run -it -p 5432:5432 -e POSTGRES_PASSWORD=contributte -e POSTGRES_USER=contributte dockette/postgres:15
       ```

       Or use make task, `make docker-postgres`.

    2. Setup MariaDB 10.4. You can start it manually or use docker image `mariadb:10.4`.

       ```bash
       docker run -it -d -p 3306:3306 -e MARIADB_ROOT_PASSWORD=contributte -e MARIADB_PASSWORD=contributte -e MARIADB_USER=contributte -e MARIADB_DATABASE=contributte mariadb:10.4
       ```

       Or use make task, `make docker-mariadb`.

3) Custom configuration file is located at `config/local.neon`. Edit it if you want.

   Default configuration should look like this. Pick PostgreSQL or MariaDB.

   ```neon
   # Host Config
   parameters:

       # Database
       database:

           # Postgres
           driver: pdo_pgsql
           host: database
           dbname: contributte
           user: contributte
           password: contributte
           port: 5432

           # MariaDB
           driver: pdo_mysql
           host: database
           dbname: contributte
           user: contributte
           password: contributte
           port: 3306
   ```

4) Ok database is now running and application is configured to connect to it. Let's create initial data.

   Run `NETTE_DEBUG=1 bin/console migrations:migrate` to create tables.
   Run `NETTE_DEBUG=1 bin/console doctrine:fixtures:load --append` to create first user(s).

   Or via task `make build`.

5) Start your devstack or use PHP local development server.

   You can start PHP server by running `php -S localhost:8000 -t www` or use prepared make task `make dev`.

6) Open http://localhost and enjoy!

   Take a look at:
    - [GET] http://localhost:8000/api/public/v1/openapi/meta (Swagger format)
    - [GET] http://localhost:8000/api/v1/users
    - [GET] http://localhost:8000/api/v1/users?_access_token=admin
    - [GET] http://localhost:8000/api/v1/users/1?_access_token=admin
    - [GET] http://localhost:8000/api/v1/users/999?_access_token=admin
    - [GET] http://localhost:8000/api/v1/users/email?email=admin@admin.cz&_access_token=admin
    - [GET] http://localhost:8000/api/v1/static/text
    - [POST] http://localhost:8000/api/v1/users/create

## Install with [docker compose](https://github.com/docker/compose)

1) At first, use composer to install this project.

   ```
   composer create-project -s dev contributte/apitte-skeleton
   ```

2) Modify `config/local.neon` and set host to `postgres` or `mariadb`

   Default configuration should look like this. There is preconfigured database. Pick PostgreSQL or MariaDB.

   ```neon
   # Host Config
   parameters:

       # Database
       database:

           # Postgres
           driver: pdo_pgsql
           host: database
           dbname: contributte
           user: contributte
           password: contributte
           port: 5432

           # MariaDB
           driver: pdo_mysql
           host: database
           dbname: contributte
           user: contributte
           password: contributte
           port: 3306
   ```

3) Run `docker-compose up`

4) Open http://localhost and enjoy!

   Take a look at:
    - [GET] http://localhost/api/public/v1/openapi/meta (Swagger format)
    - [GET] http://localhost/api/v1/users
    - [GET] http://localhost/api/v1/users?_access_token=admin
    - [GET] http://localhost/api/v1/users/1?_access_token=admin
    - [GET] http://localhost/api/v1/users/999?_access_token=admin
    - [GET] http://localhost/api/v1/users/email?email=admin@admin.cz&_access_token=admin
    - [POST] http://localhost/api/v1/users/create

## (Optional) REST API documentation

Since we have OpenAPI specification available at `/api/public/v1/openapi/meta` you just need to add UI for it (e.g. to `www/doc` directory or as a standalone application).

Available options are:

- [Swagger UI](https://swagger.io/tools/swagger-ui/) + [themes](https://github.com/ostranme/swagger-ui-themes)
- [ReDoc](https://github.com/Redocly/redoc)
- other

## Features

Here is a list of all features you can find in this project.

- PHP 8.1+
- :package: Packages
    - Nette 3+
    - Contributte
- :deciduous_tree: Structure
    - `app`
        - `config` - configuration files
            - `env` - prod/dev/test environments
            - `app` - application configs
            - `ext` - extensions configs
            - `local.neon` - local runtime config
            - `local.neon.dist` - template for local config
        - `domain` - business logic and domain specific classes
        - `model` - application backbone
        - `module` - API module
        - `resources` - static content for mails and others
        - `bootstrap.php` - Nette entrypoint
    - `bin` - console entrypoint (`bin/console`)
    - `db` - database files
        - `fixtures` - PHP fixtures
        - `migrations` - migrations files
    - `docs` - documentation
    - `vae`
        - `log` - runtime and error logs
        - `tmp` - temp files and cache
    - `tests` - test engine and many cases
        - `tests/cases/E2E` - PhpStorm's requests files (`api.http`)
        - `tests/cases/Integration`
        - `tests/cases/Unit`
    - `vendor` - composer's folder
    - `www` - public content
- :exclamation: Tracy
    - Cool error 500 page

### Composer packages

Take a detailed look :eyes: at each single package.

- [contributte/bootstrap](https://contributte.org/packages/contributte/bootstrap.html)
- [contributte/di](https://contributte.org/packages/contributte/di.html)
- [contributte/http](https://contributte.org/packages/contributte/http.html)
- [contributte/security](https://contributte.org/packages/contributte/security.html)
- [contributte/utils](https://contributte.org/packages/contributte/utils.html)
- [contributte/tracy](https://contributte.org/packages/contributte/tracy.html)
- [contributte/console](https://contributte.org/packages/contributte/console.html)
- [contributte/neonizer](https://contributte.org/packages/contributte/neonizer.html)
- [contributte/monolog](https://contributte.org/packages/contributte/monolog.html)
- [contributte/apitte](https://contributte.org/packages/contributte/apitte.html)

**Doctrine**

- [contributte/doctrine-orm](https://contributte.org/packages/contributte/doctrine-orm.html)
- [contributte/doctrine-dbal](https://contributte.org/packages/contributte/doctrine-dbal.html)
- [contributte/doctrine-migrations](https://contributte.org/packages/contributte/doctrine-migrations.html)
- [contributte/doctrine-fixtures](https://contributte.org/packages/contributte/doctrine-fixtures.html)

**Nette**

- [nette/finder](https://github.com/nette/finder)
- [nette/robot-loader](https://github.com/nette/robot-loader)

**Symfony**

- [symfony/serializer](https://github.com/symfony/serializer)
- [symfony/validator](https://github.com/symfony/validator)

## Demo

![](.docs/assets/screenshot1.png)
![](.docs/assets/screenshot2.png)
![](.docs/assets/screenshot3.png)

## Development

See [how to contribute](https://contributte.org/contributing.html) to this package.

This package is currently maintaining by these authors.

<a href="https://github.com/f3l1x">
    <img width="80" height="80" src="https://avatars2.githubusercontent.com/u/538058?v=3&s=80">
</a>

-----

Consider to [support](https://contributte.org/partners.html) **contributte** development team.
Also thank you for using this project.
