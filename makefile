start:
	docker-compose up -d --build

restart:
	docker-compose down
	docker-compose up -d --build
stop:
	docker-compose down
composer:
	docker-compose exec webserver composer install
	docker-compose exec webserver composer dumpautoload -o
composer-prod:
	docker-compose exec webserver composer install --no-dev
	docker-compose exec webserver composer dumpautoload -o