
## Practical Test

### Installation

``
git clone https://github.com/kinare/exam-table.git
``

### Install dependencies

````
composer install
````

````
npm install
````

### Configure Database in .env

````
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=exam
DB_USERNAME=root
DB_PASSWORD=
````

### Migrate and seed database

````
php artisan migrate
php artisan db:seed
````

### Build frontend assets
````
npm run prod
````

### Serve and view application
````
php artisan serve
````

http://localhost:8000/



