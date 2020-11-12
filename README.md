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
  - Update database connection variables in `.env` file
    ```sh
        DB_CONNECTION=pgsql
        DB_HOST=127.0.0.1
        DB_PORT=5432
        DB_DATABASE=database name
        DB_USERNAME=pgsql username
        DB_PASSWORD=pgsql password
    ```
  - Update Stripe variables in .`env` file
    ```sh
    STRIPE_KEY=
    STRIPE_SECRET=
    STRIPE_AMOUNT=20
    ```

  - Update Hubsopt API key variable in .`env` file
    ```sh
    HUBSPOT_APIKEY=
    ```

  - Generate application key
      ```sh
         php artisan key:generate
      ```
  - Local Development Server
      ```sh
        php artisan serve
      ```
