## About Fleet Managment

Fleet Managment is a web application (bus-booking
system) to enable users to search through trips and book seats, This project provides some features such as:

-   [API Endpoints for users to book and search for available seats](https://documenter.getpostman.com/view/12757027/TzJsexHM).
-   Docker containerize app that runs per one command.
-   Powerful authetication system using [JWT Auth](https://jwt-auth.readthedocs.io/en/develop/laravel-installation/) and [cache](https://laravel.com/docs/cache) storage.
-   [Robust front-end UI/UX using AlpineJS](https://github.com/alpinejs/alpine).
-   Mysql Relational Database

Fleet provides registration interface for users to create their accounts and track their bookings.

## Using Fleet Managment App

-   Admin Account: `admin@gmail.com` & Password: `Nady_1234`
-   Normal Account: `normal@gmail.com` & Password: `password`

## Technologies Used

-   Laravel 8
-   AlpineJs
-   Boostrap 4
-   Yajra Laravel DataTables
-   Select2 Live Search
-   JWT Auth

### How to use.

-   Clone this project `git clone corecave/fleet fleet`
-   Build App: `sudo docker-compose up -d`
-   Go to: [http://127.0.0.1:8000](http://127.0.0.1:8000)
-   Login using test accounts listed above.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
