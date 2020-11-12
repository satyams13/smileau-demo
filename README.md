# smileau-demo

### Requirements!

  - Php 7.3
  - pgsql 7.3

### Setup
  - Clone project on you local system
  - Install composer
    ```sh
        composer install
    ```
  - Copy `.env.example` to `.env` file
  - Update database connection in `.env` file
    ```sh
        DB_CONNECTION=pgsql
        DB_HOST=127.0.0.1
        DB_PORT=5432
        DB_DATABASE=database name
        DB_USERNAME=pgsql username
        DB_PASSWORD=pgsql password
    ```
  - Stripe credentials
    ```sh
    STRIPE_KEY=pk_test_51Hm2L0AWdC2MCjw58yHGUz4ejb5KPJCCzE2iVeCaq1heKee7vPufDdIMgiOFRmS2lQcKrtz9kW69boQNS5YNzakp00HzSZLw18
    STRIPE_SECRET=sk_test_51Hm2L0AWdC2MCjw55SDC5w3m9L0AE9YHALYLqsdFVGzsw2iZef60LynwksygGntQ7eZMZlJMmUGcxNLYZRSLPfMq004xTWo026
    STRIPE_AMOUNT=20
    ```

  - HubSpot key
    ```sh
    HUBSPOT_APIKEY=cea031a6-b9eb-46d8-9524-a610692fab18
    ```

  - Generate application key
      ```sh
         php artisan key:generate
      ```
  - Local Development Server
      ```sh
        php artisan serve
      ```
