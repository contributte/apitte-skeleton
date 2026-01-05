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

## What is this project?

Apitte Skeleton is a batteries-included starter kit for building REST APIs on top of Nette 3 and [contributte/apitte](https://contributte.org/packages/contributte/apitte.html). It ships with Doctrine ORM, sensible defaults, and developer tooling so you can focus on shipping features instead of wiring infrastructure.

Key features:

- PHP 8.2+ with Nette 3 and Contributte integrations
- PSR-7 API stack via Apitte
- Doctrine ORM with migrations and fixtures
- Symfony Serializer/Validator support
- QA tools preconfigured (CodeSniffer, PHPStan, Nette Tester)

Explore the live demo: https://examples.contributte.org/apitte-skeleton/

## Quick start

If you want the fastest way to try the API locally, use Docker Compose:

```bash
composer create-project -s dev contributte/apitte-skeleton
cd apitte-skeleton
cp config/local.neon.dist config/local.neon  # adjust DB credentials if needed
docker-compose up
```

Once the containers are up, open http://localhost:8000 and browse the sample endpoints:

- [GET] `/api/public/v1/openapi/meta` – OpenAPI JSON
- [GET] `/api/v1/users` – list users
- [POST] `/api/v1/users/create` – create a user

## Manual setup (no Docker)

1. Install the project:

   ```bash
   composer create-project -s dev contributte/apitte-skeleton
   cd apitte-skeleton
   ```

2. Configure your database by copying the template and setting connection details (PostgreSQL or MariaDB):

   ```bash
   cp config/local.neon.dist config/local.neon
   ```

   ```neon
   parameters:
       database:
           driver: pdo_pgsql # or pdo_mysql
           host: 127.0.0.1
           dbname: contributte
           user: contributte
           password: contributte
           port: 5432 # or 3306 for MariaDB
   ```

3. Start your database (examples):

   ```bash
docker run -p 5432:5432 -e POSTGRES_PASSWORD=contributte -e POSTGRES_USER=contributte dockette/postgres:15
# or
docker run -p 3306:3306 -e MARIADB_ROOT_PASSWORD=contributte -e MARIADB_USER=contributte -e MARIADB_PASSWORD=contributte -e MARIADB_DATABASE=contributte mariadb:10.4
   ```

4. Prepare the schema and seed data:

   ```bash
   NETTE_DEBUG=1 bin/console migrations:migrate
   NETTE_DEBUG=1 bin/console doctrine:fixtures:load --append
   ```

5. Run the development server:

   ```bash
   make dev    # or: php -S localhost:8000 -t www
   ```

## Useful commands

- `make docker-postgres` / `make docker-mariadb` – start helper DB containers
- `make build` – run migrations, load fixtures, and warm up cache
- `make qa` – run static analysis and code style checks
- `make tests` – execute the test suite

## API discovery

OpenAPI metadata is available at `/api/public/v1/openapi/meta`, so you can plug in your favorite viewer (Swagger UI, ReDoc, etc.). The repository also includes `tests/cases/E2E/api.http` with ready-to-use HTTP requests for tools like PhpStorm.

## Features

Here is a list of all features you can find in this project.

- PHP 8.2+
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
