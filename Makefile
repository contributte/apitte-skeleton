loc-postgres: loc-postgres-stop
	docker run -it -d -p 5432:5432 --name forest_postgres -e POSTGRES_PASSWORD=forest -e POSTGRES_USER=forest postgres:10

loc-postgres-stop:
	docker stop forest_postgres || true
	docker rm forest_postgres || true

loc-adminer: loc-adminer-stop
	docker run -it -d -p 9999:80 --name forest_adminer dockette/adminer:dg

loc-adminer-stop:
	docker stop forest_adminer || true
	docker rm forest_adminer || true

loc-api:
	NETTE_DEBUG=1 NETTE_ENV=dev php -S 0.0.0.0:8000 www/index.php

loc-api-prod:
	NETTE_ENV=prod php -S 0.0.0.0:8000 www/index.php
