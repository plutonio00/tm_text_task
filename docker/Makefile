up-build:
	docker-compose up -d

make-migration:
	docker-compose exec php-fpm bin/console make:migration

migrate:
	docker-compose exec php-fpm bin/console doctrine:migrations:migrate

load-fixtures:
	docker-compose exec php-fpm bin/console doctrine:fixtures:load --purge-with-truncate -n