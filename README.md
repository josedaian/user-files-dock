# PHP DOCKER BASE
Docker microservices:
- Mysql 8.0
- Nginx
- PHP 8.1

## How to install
After cloning the repository and being inside the project folder, run the following commands:
```sh
cp .env.example .env
docker-compose up
docker exec -it lara-app-api php artisan migrate
docker exec -it lara-app-api php artisan db:seed
```


## License

MIT
