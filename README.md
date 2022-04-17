## Installation

1. Clone the repo and `cd` into it
2. `composer install`
3. Rename or copy `.env.example` file to `.env`
4. Set your `TMDB_TOKEN` in your `.env` file. You can get an API key [here](https://www.themoviedb.org/documentation/api). Make sure to use the "API Read Access Token (v4 auth)" from the TMDb dashboard.
5. `php artisan key:generate`
6. `php artisan serve` or use Laravel Valet or Laravel Homestead
7. Visit `localhost:8000` in your browser
