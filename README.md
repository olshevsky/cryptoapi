# Installation

0. Clone repo to your directory.

1. In project dir run:
    - docker-compose -p cryptoapi up -d
   
2. Run:
    - docker ps
    - Copy cryptoapi_app CONTAINER ID

3. Login into cryptoapi_app container: 
    - docker exec -it {CONTAINER ID} /bin/sh

4. Install dependencies, build assets and run migrations:
    - npm install
    - npm run build
    - composer install
    - php artisan migrate
    - chmod -R 777 ./storage
    
6. To run tests:
    - open phpMyAdmin http://localhost:8080/ root/password
    - create DB laravel_test
    - Login into cryptoapi_app container docker exec -it {CONTAINER ID} /bin/sh
    - php artisan test

API URLs:
/api/v1/crypto/currencies
/api/v1/crypto/currencies/litecoin
/api/v1/crypto/currencies/bitcoin

/api/v1/user/auth
/api/v1/user/register
