up:
	docker-compose up -d
down:
	docker-compose down
build:
	docker-compose up -d --build
test:
	docker exec -it stadio_chalange php artisan test
setup:
	docker exec -it stadio_chalange php artisan redis:setup
increase_coca:
	docker exec -it stadio_chalange php artisan product:increase coca 100
increase_coffee:
	docker exec -it stadio_chalange php artisan product:increase coffee 100
redis:
	docker exec -it redis redis-cli
env:
	docker exec -it stadio_chalange cat .env
route:
	docker exec -it stadio_chalange php artisan route:list --path=api
