Generate the App Key

If this is a fresh Laravel install and you haven’t generated the key:
docker-compose exec php php artisan key:generate


docker-compose exec php php artisan config:clear

docker-compose restart 