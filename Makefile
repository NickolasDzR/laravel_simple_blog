up:
	docker compose up -d

stop:
	docker compose stop

create-laravel:
	docker run --rm -v $(PWD)/laravel:/app composer create-project laravel/laravel . --prefer-dist

init: up app-grant-write-permission app-composer-install app-migrations app-seeders app-storage-link

app-composer-install:
	docker compose run --rm laravel composer install
	docker compose run --rm laravel composer run-script post-root-package-install
	docker compose run --rm laravel composer run-script post-create-project-cmd

app-migrations:
	docker compose run --rm laravel php artisan migrate --force

app-seeders:
	docker compose run --rm laravel php artisan db:seed

app-add-admin:
	docker compose run --rm laravel php artisan user:create

app-storage-link:
	docker compose run --rm laravel php artisan storage:link

app-grant-write-permission:
	docker compose run --rm laravel chmod -R 777 ./

app-jwt:
	docker compose run --rm laravel php artisan jwt:secret
	docker compose run --rm laravel php artisan jwt:generate-certs

bash:
	docker compose run --rm --user 1000 laravel bash

bash-nginx:
	docker compose run --rm nginx bash

nginx-reload:
	docker exec -it app_nginx service nginx reload

