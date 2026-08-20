# Apitte Skeleton

Nette API project skeleton built with [contributte/apitte](https://github.com/contributte/apitte), Nettrine, and Symfony components.

## Requirements

- PHP 8.4 or newer
- [Composer](https://getcomposer.org/)
- `make` for the provided development commands

## Create the Apitte project

Create the project, copy its local configuration, and prepare writable runtime directories without reinstalling dependencies:

```bash
composer create-project contributte/apitte-skeleton acme
cd acme
make init
make setup
```

`make init` creates `config/local.neon` from `config/local.neon.example`. Composer already installs dependencies during project creation.

## Run PHP natively with PostgreSQL 15

Start PostgreSQL 15, matching the default `serverVersion: "15"` configuration:

```bash
docker run --rm -p 5432:5432 \
  -e POSTGRES_PASSWORD=contributte \
  -e POSTGRES_USER=contributte \
  -e POSTGRES_DB=contributte \
  dockette/postgres:15
```

When PHP runs on your host, keep the database host in `config/local.neon` as `127.0.0.1` (or another host-reachable address). In another terminal, rebuild the development database and start the API:

```bash
make build
XDEBUG_MODE=debug NETTE_DEBUG=1 NETTE_ENV=dev php -S 0.0.0.0:8000 -t www www/index.php
```

Passing `www/index.php` as the router lets the PHP development server handle API paths; the current `make dev` target omits it. **Warning:** `make build` is destructive: it drops the entire configured database schema before running migrations and loading fixtures. Use it only against a disposable development database.

## Run with Docker Compose

Docker Compose runs PHP and its databases in containers. Set `database.host` in `config/local.neon` to the selected service name, `postgres` or `mariadb`; unlike native PHP, containerized PHP must not use `127.0.0.1` for the database.

The tracked Compose PostgreSQL service uses PostgreSQL 13. If you select it, also set `database.serverVersion` to `"13"`; the default local configuration targets PostgreSQL 15.

```bash
docker compose up
```

The tracked Compose file publishes the application on <http://localhost:8000> and also binds host ports `5432`, `3306`, `8080`, and `8443`. If any of those ports is already in use, Compose cannot start without changing the tracked port mapping.

## Prove OpenAPI and fixture access

Verify that public OpenAPI generation works and that the loaded admin fixture can access a protected purpose route:

```bash
curl --fail http://localhost:8000/api/public/v1/openapi/meta
curl --fail -H 'X-Token: admin' http://localhost:8000/api/v1/users
```

The first request returns the generated API definition. The second returns users through an authenticated route using the `admin` API key loaded by `make build`. The authenticator also accepts `_access_token=admin` as a query parameter, but headers avoid placing credentials in URLs.

## Development

```bash
make qa       # coding standard and static analysis
make tests    # Nette Tester suite
make cs       # coding standard check
make csf      # fix coding standard issues
make phpstan  # static analysis
make coverage # generate coverage.xml
```
