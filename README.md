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

## What is Apitte Skeleton?

**Apitte Skeleton** is a fully-featured, production-ready starter template for building modern REST APIs with PHP. It combines the best packages from the Nette and Contributte ecosystems to give you a solid foundation for your API project.

Perfect for developers who want to:
- 🚀 Start building APIs quickly without boilerplate setup
- 📚 Learn best practices for PHP API development
- 🏗️ Build production-ready REST/JSON APIs with proper architecture
- 🔒 Implement authentication, validation, and database management out of the box

### What's Inside?

- **Modern PHP 8.2+** with strict types and best practices
- **RESTful API** built with [Apitte](https://contributte.org/packages/contributte/apitte.html) (PSR-7 compliant)
- **Database ORM** with [Doctrine](https://www.doctrine-project.org/) and migrations support
- **OpenAPI/Swagger** documentation auto-generation
- **Authentication** with token-based security
- **Input Validation** using Symfony Validator
- **Code Quality Tools** (PHPStan, CodeSniffer)
- **Testing Suite** with Nette Tester
- **Docker Support** for easy deployment
- **Example Endpoints** to learn from

### Live Demo

Try it out: https://examples.contributte.org/apitte-skeleton/

## Prerequisites

Before you begin, make sure you have:

- **PHP 8.2 or higher** installed
- **Composer** (PHP package manager)
- **Docker & Docker Compose** (recommended) OR
- **PostgreSQL 13+** or **MariaDB 10.4+** (if not using Docker)
- Basic knowledge of PHP and REST APIs

## 🚀 Quick Start (Recommended)

The easiest way to get started is using **Docker Compose**, which sets up everything automatically.

### Option 1: Docker Compose (Easiest - Recommended for Beginners)

```bash
# 1. Create a new project
composer create-project -s dev contributte/apitte-skeleton my-api-project
cd my-api-project

# 2. Start the application (this will download Docker images, install dependencies, and set up the database)
docker-compose up
```

That's it! 🎉 The API is now running at **http://localhost:8000**

> **Note**: The first run takes a few minutes to download Docker images and set up everything. Subsequent starts are much faster.

### Option 2: Manual Setup with Docker Database

If you prefer more control or want to run PHP locally:

```bash
# 1. Create a new project
composer create-project -s dev contributte/apitte-skeleton my-api-project
cd my-api-project

# 2. Install dependencies
composer install

# 3. Create local configuration
cp config/local.neon.example config/local.neon

# 4. Start a database (choose PostgreSQL OR MariaDB)

# PostgreSQL (recommended):
make docker-postgres

# OR MariaDB:
make docker-mariadb

# 5. Set up the database schema and load sample data
make build

# 6. Start the PHP development server
make dev
```

Your API is now running at **http://localhost:8000**

### Option 3: Full Manual Setup (Advanced)

If you have your own database server:

```bash
# 1. Create the project
composer create-project -s dev contributte/apitte-skeleton my-api-project
cd my-api-project

# 2. Install dependencies
composer install

# 3. Configure your database connection
# Edit config/local.neon with your database credentials
cp config/local.neon.example config/local.neon
nano config/local.neon  # or use your favorite editor

# 4. Set up database
NETTE_DEBUG=1 bin/console migrations:migrate --no-interaction
NETTE_DEBUG=1 bin/console doctrine:fixtures:load --no-interaction

# 5. Start PHP server
php -S localhost:8000 -t www
```

## 🧪 Try Out the API

Once your server is running, try these example endpoints:

### Public Endpoints (No Authentication)
- **API Documentation**: http://localhost:8000/api/public/v1/openapi/meta  
  OpenAPI/Swagger specification for all endpoints

### Protected Endpoints (Use `?_access_token=admin`)

The skeleton comes with a demo user. Use `_access_token=admin` to authenticate:

- **List all users**  
  http://localhost:8000/api/v1/users?_access_token=admin

- **Get specific user**  
  http://localhost:8000/api/v1/users/1?_access_token=admin

- **Find user by email**  
  http://localhost:8000/api/v1/users/email?email=admin@admin.cz&_access_token=admin

- **Static text example**  
  http://localhost:8000/api/v1/static/text?_access_token=admin

### Testing Different Responses

- **User not found (404)**  
  http://localhost:8000/api/v1/users/999?_access_token=admin

- **Error handling example**  
  http://localhost:8000/api/v1/error/exception?_access_token=admin

### Create a New User (POST)

```bash
curl -X POST http://localhost:8000/api/v1/users/create \
  -H "Content-Type: application/json" \
  -d '{"name":"John Doe","email":"john@example.com"}'
```

## 📖 API Documentation UI

The skeleton provides OpenAPI specification, but you can add a visual UI for better documentation:

**OpenAPI Spec**: http://localhost:8000/api/public/v1/openapi/meta

### Add Swagger UI (Optional)

1. Download [Swagger UI](https://github.com/swagger-api/swagger-ui/releases)
2. Extract to `www/docs/`
3. Point it to `/api/public/v1/openapi/meta`
4. Access at http://localhost:8000/docs/

**Alternatives**: [ReDoc](https://github.com/Redocly/redoc), [Swagger UI Themes](https://github.com/ostranme/swagger-ui-themes)

## 🛠️ Available Commands

The project includes helpful `make` commands:

### Development
```bash
make dev          # Start PHP development server
make build        # Rebuild database schema and load fixtures
make clean        # Clear cache and logs
```

### Code Quality
```bash
make qa           # Run all quality checks (cs + phpstan)
make cs           # Check code style
make csf          # Fix code style issues
make phpstan      # Run static analysis
make tests        # Run test suite
make coverage     # Generate test coverage report
```

### Database Tools
```bash
make docker-postgres  # Start PostgreSQL in Docker
make docker-mariadb   # Start MariaDB in Docker
make docker-adminer   # Start Adminer (DB management UI)
```

Access Adminer at http://localhost:8080 when using Docker Compose.

## 📁 Project Structure

Understanding the folder structure helps you navigate the codebase:

```
apitte-skeleton/
├── app/                      # Application code
│   ├── Domain/              # Business logic and entities
│   │   └── User/           # User domain (entity, repository, etc.)
│   ├── Model/              # Application services and backbone
│   ├── Module/             # API controllers
│   │   ├── PubV1/         # Public API v1 (no auth required)
│   │   └── V1/            # Protected API v1 (auth required)
│   └── Bootstrap.php       # Application bootstrap
│
├── config/                  # Configuration files
│   ├── env/                # Environment-specific configs (dev/prod/test)
│   ├── local.neon          # Your local config (git-ignored)
│   └── local.neon.example  # Template for local config
│
├── db/                      # Database files
│   ├── fixtures/           # Sample data (PHP fixtures)
│   └── migrations/         # Database migrations
│
├── tests/                   # Test suite
│   ├── cases/E2E/          # End-to-end tests (API requests)
│   ├── cases/Integration/  # Integration tests
│   └── cases/Unit/         # Unit tests
│
├── var/                     # Runtime files
│   ├── log/                # Application logs
│   └── tmp/                # Cache and temporary files
│
├── www/                     # Public web root
│   └── index.php           # Entry point
│
├── bin/                     # Executable scripts
│   └── console             # CLI console for commands
│
└── docker-compose.yml       # Docker Compose configuration
```

### Key Files

- **app/Module/V1/UsersController.php** - Example API controller
- **app/Domain/User/User.php** - Example entity
- **config/ext/apitte.neon** - API routing configuration
- **db/fixtures/UserFixture.php** - Sample user data

## 🎯 Next Steps

Now that you have the API running, here's what you can do:

1. **Explore the Code**
   - Check out `app/Module/V1/UsersController.php` to see how endpoints are built
   - Look at `app/Domain/User/User.php` to understand the entity structure
   - Review `config/ext/apitte.neon` for API configuration

2. **Create Your First Endpoint**
   - Add a new controller in `app/Module/V1/`
   - Define routes using Apitte annotations
   - Register it in the DI container

3. **Customize the Database**
   - Modify entities in `app/Domain/`
   - Create migrations: `bin/console migrations:diff`
   - Apply migrations: `bin/console migrations:migrate`

4. **Add Your Business Logic**
   - Create new domains in `app/Domain/`
   - Add services in `app/Model/`
   - Write tests in `tests/`

5. **Learn from Examples**
   - Study the included User CRUD endpoints
   - Check the authentication middleware
   - Review validation rules

## 📚 Documentation & Resources

- **Apitte Documentation**: https://contributte.org/packages/contributte/apitte.html
- **Nette Framework**: https://nette.org/
- **Doctrine ORM**: https://www.doctrine-project.org/
- **All Contributte Packages**: https://contributte.org/

## 🐛 Troubleshooting

### Port Already in Use
```bash
# If port 8000 is busy, use a different port:
php -S localhost:3000 -t www
```

### Database Connection Issues
- Verify your database is running: `docker ps`
- Check `config/local.neon` has correct credentials
- For Docker Compose, use `host: postgres` or `host: mariadb`
- For local databases, use `host: 127.0.0.1`

### Permission Errors
```bash
# Fix permissions for var/ directories:
chmod -R 0777 var/tmp var/log
```

### Composer Issues
```bash
# Clear Composer cache and reinstall:
composer clear-cache
rm -rf vendor/
composer install
```

### Database Not Created
```bash
# Rebuild database from scratch:
make build
```

### Cache Issues
```bash
# Clear application cache:
make clean
```

## 🔒 Security Notes

- The default admin token (`admin`) is for **development only**
- Change authentication mechanism for production
- Never commit `config/local.neon` (it's git-ignored by default)
- Review security settings before deploying

## 🤝 Contributing

Want to contribute? Great! Check out:
- [Contributing Guide](https://contributte.org/contributing.html)
- Report issues on [GitHub](https://github.com/contributte/apitte-skeleton/issues)
- Join the community on [Gitter](https://bit.ly/ctteg)

## 📝 Technical Details

### Technology Stack

Here is a list of all features and technologies included in this project:

- **PHP 8.2+** with modern features
- :package: **Core Packages**
    - Nette 3+ Framework
    - Contributte Ecosystem
- :deciduous_tree: **Project Structure**
    - `app/`
        - `Domain/` - business logic and domain entities
        - `Model/` - application services
        - `Module/` - API controllers (PubV1, V1)
        - `Bootstrap.php` - application entrypoint
    - `config/` - configuration files
        - `env/` - environment configs (prod/dev/test)
        - `local.neon` - local configuration
    - `bin/console` - CLI console
    - `db/` - database files
        - `fixtures/` - sample data
        - `migrations/` - database migrations
    - `var/`
        - `log/` - application logs
        - `tmp/` - cache and temp files
    - `tests/` - test suite
        - `cases/E2E/` - end-to-end API tests
        - `cases/Integration/` - integration tests
        - `cases/Unit/` - unit tests
    - `www/` - public webroot
- :exclamation: **Error Handling**
    - Tracy debugger with beautiful error pages

### Included Composer Packages

Take a detailed look :eyes: at each package:

**Core Contributte Packages**
- [contributte/bootstrap](https://contributte.org/packages/contributte/bootstrap.html) - Enhanced Nette bootstrapping
- [contributte/di](https://contributte.org/packages/contributte/di.html) - Dependency injection extensions
- [contributte/http](https://contributte.org/packages/contributte/http.html) - HTTP helpers and utilities
- [contributte/security](https://contributte.org/packages/contributte/security.html) - Security components
- [contributte/utils](https://contributte.org/packages/contributte/utils.html) - Common utilities
- [contributte/tracy](https://contributte.org/packages/contributte/tracy.html) - Enhanced Tracy debugger
- [contributte/console](https://contributte.org/packages/contributte/console.html) - Symfony Console integration
- [contributte/monolog](https://contributte.org/packages/contributte/monolog.html) - Monolog logging
- [contributte/apitte](https://contributte.org/packages/contributte/apitte.html) - **API framework** (the star of the show!)

**Database (Nettrine/Doctrine)**
- [nettrine/orm](https://contributte.org/packages/nettrine/orm.html) - Doctrine ORM integration
- [nettrine/dbal](https://contributte.org/packages/nettrine/dbal.html) - Database abstraction layer
- [nettrine/migrations](https://contributte.org/packages/nettrine/migrations.html) - Database migrations
- [nettrine/fixtures](https://contributte.org/packages/nettrine/fixtures.html) - Test data fixtures

**Symfony Components**
- [symfony/serializer](https://symfony.com/doc/current/components/serializer.html) - Object serialization
- [symfony/validator](https://symfony.com/doc/current/components/validator.html) - Input validation

**Development Tools**
- [contributte/qa](https://contributte.org/packages/contributte/qa.html) - Code quality tools
- [contributte/phpstan](https://contributte.org/packages/contributte/phpstan.html) - Static analysis
- [nette/tester](https://tester.nette.org/) - Testing framework

## 📸 Screenshots

![](.docs/assets/screenshot1.png)
![](.docs/assets/screenshot2.png)
![](.docs/assets/screenshot3.png)

## 👥 Development & Support

### Getting Help

- 💬 **Gitter Chat**: [Join the conversation](https://bit.ly/ctteg)
- 💡 **Forum**: [Ask questions](https://bit.ly/cttfo)
- 🐛 **Issues**: [Report bugs](https://github.com/contributte/apitte-skeleton/issues)
- 📖 **Documentation**: [contributte.org](https://contributte.org)

### Contributing

See [how to contribute](https://contributte.org/contributing.html) to this package. We welcome:
- Bug reports and fixes
- Documentation improvements
- Feature suggestions
- Code contributions

### Maintainers

This package is currently maintained by:

<a href="https://github.com/f3l1x">
    <img width="80" height="80" src="https://avatars2.githubusercontent.com/u/538058?v=3&s=80">
</a>

-----

Consider to [support](https://contributte.org/partners.html) **contributte** development team.
Also thank you for using this project.
