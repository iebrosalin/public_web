start:
	docker-compose up -d --build
restart:
	docker-compose down
	docker-compose up -d --build
stop:
	docker-compose down
composer:
	docker-compose exec php-fpm composer install
	docker-compose exec php-fpm composer dumpautoload -o