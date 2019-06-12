<h1 align=center>Forest Project</h1>

<p align=center>
    <strong>Forest project</strong> is an example project based on Nette Framework and many useful packages by <a href="https://github.com/f3l1x">@f3l1x</a>.
</p>

<p align=center>
    Why <strong>forest</strong>? Because we are building (fo)REST API.
</p>

<p align=center>
🕹 <a href="https://f3l1x.io">f3l1x.io</a> | 💻 <a href="https://github.com/f3l1x">f3l1x</a> | 🐦 <a href="https://twitter.com/xf3l1x">@xf3l1x</a>
</p>

<p align=center>
    <code>composer create-project -s dev planette/forest-project acme</code>
</p>
<p align=center>
    Take a look at demo <a href="https://examples.contributte.org/planette/forest-project/api/v1/users/?_access_token=admin">examples.contributte.org/planette/forest-project/</a>
</p>

<p align=center>
    <img src="https://raw.githubusercontent.com/planette/forest-project/master/.docs/assets/screenshot1.png">
</p>

[![Build Status](https://img.shields.io/travis/planette/forest-project.svg?style=flat-square)](https://travis-ci.org/planette/forest-project)
[![Join the chat](https://img.shields.io/gitter/room/contributte/contributte.svg?style=flat-square)](http://bit.ly/ctteg)

-----

## Goal

Main goal is to provide best prepared API starter-kit project for Nette-Apitte developers.

Focused on:

- `nette/*` packages
- build PSR-7 API via `apitte/*`
- Doctrine ORM via `nettrine/*`
- Symfony components via `contributte/*`
- codestyle checking via **CodeSniffer** and `ninjify/*`
- static analysing via **phpstan**
- unit / integration tests via **Nette Tester** and `ninjify/*`

## Install

1) At first, use composer to install this project.

    ```
    composer create-project planette/forest-project
    ```

2) After that, you have to setup Postgres >= 10 database. You can start it manually or use docker image `postgres:10`.

    ```
    docker run -it -p 5432:5432 -e POSTGRES_PASSWORD=forest -e POSTGRES_USER=forest postgres:10
    ```

    Or use make task, `make loc-postgres`.

4) Custom configuration file is located at `app/config/config.local.neon`. Edit it if you want.

    Default configuration should look like:

    ```yaml
    # Host Config
    parameters:

        # Database
        database:
            host: localhost
            dbname: forest
            user: forest
            password: forest
    ```

5) Ok database is now running and application is configured to connect to it. Let's create initial data.

    Run `NETTE_DEBUG=1 bin/console migrations:migrate` to create tables.
    Run `NETTE_DEBUG=1 bin/console doctrine:fixtures:load --append` to create first user(s).

    Or via task `make build`.

6) Start your devstack or use PHP local development server.

    You can start PHP server by running `php -S localhost:8000 -t www` or use prepared make task `make loc-api`.

7) Open http://localhost and enjoy!

    Take a look at:
    - [GET] http://localhost:8000/api/public/v1/openapi/meta (Swagger format)
    - [GET] http://localhost:8000/api/v1/users
    - [GET] http://localhost:8000/api/v1/users?_access_token=admin
    - [GET] http://localhost:8000/api/v1/users/1?_access_token=admin
    - [GET] http://localhost:8000/api/v1/users/999?_access_token=admin
    - [GET] http://localhost:8000/api/v1/users/email?email=admin@admin.cz&_access_token=admin
    - [POST] http://localhost:8000/api/v1/users/create
    
    If you're using docker-compose your application is running on port 80 so you don't need to specify port 8000 in the URLs.

## Features

Here is a list of all features you can find in this project.

- :package: Packages
    - Nette 3.0
    - Apitte
    - Contributte
    - Nettrine
- :deciduous_tree: Structure
    - `app`
        - `config` - configuration files
            - `env` - prod/dev/test environments
            - `app` - application configs
            - `ext` - extensions configs
            - `config.local.neon` - local runtime config
            - `config.local.neon.dist` - template for local config
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
    - `log` - runtime and error logs
    - `temp` - temp files and cache
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

**Apitte**

- [apitte/core](https://contributte.org/packages/apitte/core.html)
- [apitte/debug](https://contributte.org/packages/apitte/debug.html)
- [apitte/middlewares](https://contributte.org/packages/apitte/middlewares.html)
- [apitte/openapi](https://contributte.org/packages/apitte/openapi.html)

**Nettrine**

- [nettrine/orm](https://contributte.org/packages/nettrine/orm.html)
- [nettrine/dbal](https://contributte.org/packages/nettrine/dbal.html)
- [nettrine/migrations](https://contributte.org/packages/nettrine/migrations.html)
- [nettrine/fixtures](https://contributte.org/packages/nettrine/fixtures.html)
- [nettrine/extensions](https://contributte.org/packages/nettrine/extensions.html)

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
