# Lumen 5.4 Boilerplate

> [Lumen 5.4](http://lumen.laravel.com/docs) boilerplate for starting your first API.

## Features

- HTTP [Exception Handler](https://lumen.laravel.com/docs/5.4/errors) with JSON responses. [see reference](https://gist.github.com/joseluisq/bea6220cca5e1441d550b27409283497)
- Fecades and [Eloquent](https://laravel.com/docs/5.4/eloquent) enabled by default.
- [Lumen Passport](https://github.com/dusterio/lumen-passport) configured for OAuth2 support.
- [Lumen Generators](https://github.com/webNeat/lumen-generators) with REST actions trait.
- [Carbon](https://github.com/briannesbitt/Carbon).
- `.editorconfig` settings.
- ...

## Configuration

```sh
# 1. Clone this repository
git clone --depth 1 https://github.com/joseluisq/lumen-54-boilerplate.git myapi

# 2. Enter to cloned directory
cd myapi

# 3. Install the dependencies
composer install

# 4. Run the migration
php artisan migrate

# 5. Configure Passport
php artisan passport:install
```

## Usage

```sh
# 1. Run the development server
php -S localhost:8002 -t ./public

# 2. Request for some token

curl \
    -X POST "http://localhost:8002/oauth/token" \
    -d "grant_type=password" \
    -d "client_id=1" \
    -d "client_secret=FNjxzm1V5fZC52ZSvrEK7bpUMhedQYndl7n3s0nr" \
    -d "username=admin@mail.com" \
    -d "password=123456"

# 3. Request to an example url (use the "access_token" value for Bearer)
curl \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJ..." \
    -X GET "http://localhost:8002/api/v1"

# Response:
# {"version":"Lumen (5.4.6) (Laravel Components 5.4.*)"}
```

## Contribution
Feel free to send issues or pull requests.

## License
MIT license

© 2017 [José Luis Quintana](https://git.io/joseluisq)
