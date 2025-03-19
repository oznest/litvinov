build:
	docker-compose up -d --build
up:
	docker-compose up -d
down:
	docker-compose down
sh:
	docker exec -it symfony_php /bin/bash