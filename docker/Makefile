up-build:
	docker-compose up -d

make-migration:
	docker-compose exec php-fpm bin/console make:migration

migrate:
	docker-compose exec php-fpm bin/console doctrine:migrations:migrate

load-fixtures:
	docker-compose exec php-fpm bin/console doctrine:fixtures:load --purge-with-truncate -n

add-env:
	cd ../ && cp -n .env.example .env && cd docker && cp -n .env.example .env

composer-install:
	docker-compose exec php-fpm composer install

test:
	docker-compose exec php-fpm bin/phpunit

clear-cache:
	docker-compose exec php-fpm bin/console cache:clear