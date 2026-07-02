up:                  # docker compose up -d --build
	docker compose up -d --build

down:                # docker compose down
	docker compose down

restart:             # docker compose restart
	docker compose restart

logs:                # docker compose logs -f
	docker compose logs -f

shell:               # docker compose exec app sh
	docker compose exec app sh

tinker:              # docker compose exec app php artisan tinker
	docker compose exec app php artisan tinker

migrate:             # docker compose exec app php artisan migrate
	docker compose exec app php artisan migrate

seed:                # docker compose exec app php artisan db:seed
	docker compose exec app php artisan db:seed

composer-install:    # docker compose exec app composer install
	docker compose exec app composer install

fresh:               # docker compose exec app php artisan migrate:fresh --seed
	docker compose exec app php artisan migrate:fresh --seed

cache-clear:         # docker compose exec app php artisan optimize:clear
	docker compose exec app php artisan optimize:clear
