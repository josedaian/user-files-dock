# Jornada de almuerzo ¡gratis!
This is a restaurant web app to get free bulk order requests to manage them via queue events.

Docker microservices:
- Mysql 8.0
- Nginx
- PHP 8.1
- Laravel 8.75.0
## Features
The project has an API that is responsible for processing all requests through [Laravel Queues](https://laravel.com/docs/8.x/queues).
On the client side, which is also made in Laravel, the free html template [AdminLTE](https://adminlte.io) was used.

## How to install
After cloning the repository and being inside the project folder, run the following commands:
```sh
cp .env.example .env
docker-compose up
docker exec -it restaurant-api php artisan migrate
docker exec -it restaurant-api php artisan db:seed
docker exec -it restaurant-api php artisan queue:work &
```


## License

MIT
