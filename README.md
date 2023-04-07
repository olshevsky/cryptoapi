# Installation

0. Clone repo to your directory.

1. In project dir run:
    docker-compose -p cryptoapi up -d
   
2. Run:
    docker ps
    Copy cryptoapi_app CONTAINER ID

3. Login into cryptoapi_app container: 
    docker exec -it {CONTAINER ID} /bin/sh

4. Install dependencies, build assets and run migrations:
    - npm install
    - npm run build
    - composer install
    - php artisan migrate
    
5. Run tests:
    php artisan test
