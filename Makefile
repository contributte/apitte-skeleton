.PHONY: qa cs cfx phpstan tests build

qa: cs phpstan

cs:
	vendor/bin/codesniffer app tests

cfx:
	vendor/bin/codefixer app tests

phpstan:
	vendor/bin/phpstan analyse -l 8 -c phpstan.neon --memory-limit=512M app tests/toolkit

tests:
	vendor/bin/tester -s -p php --colors 1 -C tests

tests-coverage:
	vendor/bin/tester -s -p phpdbg --colors 1 -C --coverage ./coverage.xml --coverage-src ./app tests

#####################
# LOCAL DEVELOPMENT #
#####################

build:
	NETTE_DEBUG=1 bin/console orm:schema-tool:drop --force --full-database
	NETTE_DEBUG=1 bin/console migrations:migrate --no-interaction
	NETTE_DEBUG=1 bin/console doctrine:fixtures:load --no-interaction --append

loc-api:
	NETTE_DEBUG=1 NETTE_ENV=dev php -S 0.0.0.0:8000 -t www www/index.php

loc-api-prod:
	NETTE_ENV=prod php -S 0.0.0.0:8000 www/index.php

loc-postgres: loc-postgres-stop
	docker run -it -d -p 5432:5432 --name apitte_postgres -e POSTGRES_PASSWORD=apitte -e POSTGRES_USER=apitte postgres:10

loc-postgres-stop:
	docker stop apitte_postgres || true
	docker rm apitte_postgres || true

loc-mariadb: loc-mariadb-stop
	docker run -it -d -p 3306:3306 --name apitte_mariadb -e MARIADB_ROOT_PASSWORD=apitte -e MARIADB_PASSWORD=apitte -e MARIADB_USER=apitte -e MARIADB_DATABASE=apitte mariadb:10.4

loc-mariadb-stop:
	docker stop apitte_mariadb || true
	docker rm apitte_mariadb || true

loc-adminer: loc-adminer-stop
	docker run -it -d -p 9999:80 --name apitte_adminer dockette/adminer:dg

loc-adminer-stop:
	docker stop apitte_adminer || true
	docker rm apitte_adminer || true
