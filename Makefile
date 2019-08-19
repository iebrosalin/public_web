start:
	docker-compose up -d --build
restart:
	docker-compose down
	docker-compose up -d --build
stop:
	docker-compose down
