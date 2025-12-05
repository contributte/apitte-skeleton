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
Website <a href="https://contributte.org">contributte.org</a> | Contact <a href="https://f3l1x.io">f3l1x.io</a> | Twitter <a href="https://twitter.com/contributte">@contributte</a>
</p>

<p align=center>
    <img src="https://api.microlink.io?url=https%3A%2F%2Fexamples.contributte.org%2Fapitte-skeleton%2F&overlay.browser=light&screenshot=true&meta=false&embed=screenshot.url"></img>
</p>

-----

## What is Apitte Skeleton?

**Apitte Skeleton** is a ready-to-use starter kit for building modern REST APIs in PHP. If you're looking to create a JSON API with proper authentication, database support, and automatic documentation - this project gives you everything you need to get started in minutes.

Think of it as a "batteries included" foundation for your next API project, built on the rock-solid [Nette Framework](https://nette.org).

### Why use this skeleton?

- **Quick Setup** - Start building your API immediately, not tomorrow
- **Production Ready** - Built with best practices and real-world requirements in mind
- **Well Documented** - OpenAPI/Swagger documentation out of the box
- **Modern PHP** - PHP 8.2+ with full type safety and modern practices
- **Flexible Database** - Works with PostgreSQL or MariaDB/MySQL
- **Docker Ready** - Spin up your dev environment with a single command
- **Fully Tested** - Includes unit, integration, and E2E test setup

## Live Demo

Try it yourself: https://examples.contributte.org/apitte-skeleton/

## Quick Start (5 minutes)

The fastest way to get up and running is with Docker Compose:

```bash
# 1. Create the project
composer create-project -s dev contributte/apitte-skeleton
cd apitte-skeleton

# 2. Initialize local configuration
make init

# 3. Start everything (database + webserver)
docker-compose up

# 4. Open your browser
# http://localhost:8000
```

That's it! Your API is now running with a PostgreSQL database and sample data.

### Try your first request

```bash
# Get the OpenAPI documentation
curl http://localhost:8000/api/public/v1/openapi/meta

# List all users (requires authentication)
curl "http://localhost:8000/api/v1/users?_access_token=admin"

# Get a specific user
curl "http://localhost:8000/api/v1/users/1?_access_token=admin"
```

## Manual Installation (without Docker)

If you prefer to run things locally:

### 1. Create the project

```bash
composer create-project -s dev contributte/apitte-skeleton
cd apitte-skeleton
make init
```

### 2. Start a database

**Option A: PostgreSQL**
```bash
docker run -it -p 5432:5432 \
  -e POSTGRES_PASSWORD=contributte \
  -e POSTGRES_USER=contributte \
  dockette/postgres:15
```

**Option B: MariaDB**
```bash
docker run -it -d -p 3306:3306 \
  -e MARIADB_ROOT_PASSWORD=contributte \
  -e MARIADB_PASSWORD=contributte \
  -e MARIADB_USER=contributte \
  -e MARIADB_DATABASE=contributte \
  mariadb:10.4
```

### 3. Configure the database connection

Edit `config/local.neon` and update the database section:

```neon
parameters:
    database:
        # For PostgreSQL:
        driver: pdo_pgsql
        host: localhost
        port: 5432
        dbname: contributte
        user: contributte
        password: contributte

        # For MariaDB, use instead:
        # driver: pdo_mysql
        # host: localhost
        # port: 3306
```

### 4. Set up the database

```bash
# Create tables
NETTE_DEBUG=1 bin/console migrations:migrate

# Load sample data
NETTE_DEBUG=1 bin/console doctrine:fixtures:load --append
```

### 5. Start the development server

```bash
make dev
# or: php -S localhost:8000 -t www
```

Open http://localhost:8000 and you're ready to go!

## API Endpoints

### Public Endpoints (no authentication required)

| Method | URL | Description |
|--------|-----|-------------|
| GET | `/api/public/v1/openapi/meta` | OpenAPI/Swagger specification |

### Protected Endpoints (authentication required)

Add `?_access_token=admin` to your requests to authenticate.

| Method | URL | Description |
|--------|-----|-------------|
| GET | `/api/v1/users` | List all users (supports `limit` and `offset`) |
| GET | `/api/v1/users/{id}` | Get user by ID |
| GET | `/api/v1/users/email?email=...` | Get user by email |
| POST | `/api/v1/users/create` | Create a new user |
| GET | `/api/v1/static/text` | Get static configured text |

### Creating a User

```bash
curl -X POST "http://localhost:8000/api/v1/users/create?_access_token=admin" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John",
    "surname": "Doe",
    "email": "john@example.com",
    "username": "johndoe",
    "password": "secret123"
  }'
```

## Project Structure

```
apitte-skeleton/
├── app/                    # Application code
│   ├── Domain/             # Business logic (entities, repositories, DTOs)
│   ├── Model/              # Infrastructure (auth, middleware, utilities)
│   ├── Module/             # API controllers
│   │   ├── PubV1/          # Public endpoints (no auth)
│   │   └── V1/             # Protected endpoints
│   └── Bootstrap.php       # Application entry point
│
├── config/                 # Configuration
│   ├── app/                # App-specific config
│   ├── env/                # Environment configs (dev/prod/test)
│   ├── ext/                # Extension configs (apitte, doctrine, etc.)
│   └── local.neon          # Your local config (gitignored)
│
├── db/                     # Database
│   ├── Fixtures/           # Sample data loaders
│   └── Migrations/         # Schema migrations
│
├── tests/                  # Test suites
│   └── cases/              # Unit, Integration, E2E tests
│
├── www/                    # Web root (public files)
└── var/                    # Runtime (logs, cache, temp)
```

## Adding API Documentation UI

The project provides an OpenAPI specification at `/api/public/v1/openapi/meta`. To add a visual documentation interface, you can use:

- [Swagger UI](https://swagger.io/tools/swagger-ui/) - Interactive API explorer
- [ReDoc](https://github.com/Redocly/redoc) - Clean, responsive documentation

Simply add the UI files to your `www/` directory and point them to the OpenAPI endpoint.

## Tech Stack

| Category | Technologies |
|----------|--------------|
| **Framework** | Nette 3+, Apitte (PSR-7 REST API) |
| **Database** | Doctrine ORM via Nettrine |
| **Validation** | Symfony Validator |
| **Serialization** | Symfony Serializer |
| **Testing** | Nette Tester, Mockery |
| **Code Quality** | PHPStan, CodeSniffer |
| **Logging** | Monolog |
| **Debugging** | Tracy |

## Useful Commands

```bash
make init           # Create local.neon from template
make setup          # Create var/ directories
make dev            # Start development server
make build          # Run migrations and load fixtures
make tests          # Run test suite
make phpstan        # Run static analysis
make cs             # Check coding standards
make csf            # Fix coding standards
make docker-postgres   # Start PostgreSQL container
make docker-mariadb    # Start MariaDB container
```

## Need Help?

- Check out the [Contributte documentation](https://contributte.org)
- Join the [Gitter chat](https://bit.ly/ctteg) for community support
- Visit the [forum](https://bit.ly/cttfo) for discussions
- Browse [Apitte documentation](https://contributte.org/packages/contributte/apitte.html) for API-specific features

## Contributing

See [how to contribute](https://contributte.org/contributing.html) to this package.

This package is currently maintained by:

<a href="https://github.com/f3l1x">
    <img width="80" height="80" src="https://avatars2.githubusercontent.com/u/538058?v=3&s=80">
</a>

-----

Consider [supporting](https://contributte.org/partners.html) the **contributte** development team. Thank you for using this project!
