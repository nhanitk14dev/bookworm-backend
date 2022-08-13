# Overview Bookworm Backend
Bookworm site using the Laravel v8.0 framework to build a backend system that provides API endpoints.

## Installation
-----
- Documentation: https://laravel.com/docs/8.x/installation#getting-started-on-linux
- cd folder: curl -s https://laravel.build/bookmark | bash
- Config env with docker:
     - DB_CONNECTION=pgsql
    - DB_HOST=db
    - DB_PORT=5432
    - DB_DATABASE=bookworm
    - DB_USERNAME=bookworm
    - DB_PASSWORD=bookworm.
- Run: php artisan migrate:fresh --seed

- Config Mysql in .env:
  + DB_CONNECTION=mysql
  + DB_HOST=127.0.0.1
  + DB_PORT=3306
  + DB_DATABASE=bookworm
  + DB_USERNAME=root
  + DB_PASSWORD=

- Run command line: 
  + Run installed packages: composer install
  + Generate new key: php artisan key:generate
  + Run migrations: php artisan make:migrate
  + Run DB seeds: php artisan db:seed
## Build Docker
-----
	URL: https://docs.docker.com/engine/installation/linux/ubuntulinux
	Install: https://docs.docker.com/engine/install/ubuntu
	CMD: https://docs.docker.com/engine/reference/commandline/version
	Docker Web: hitalos/laravel: https://github.com/hitalos/laravel => http://localhost:80
	adminer: https://hub.docker.com/_/adminer => http://localhost:8080
	mailcatcher: https://hub.docker.com/r/schickling/mailcatcher => http://localhost:1080

    - Define a Dockerfile in folder phpdocker & create new file docker-compose.yml.
    - CMD docker:
		Build: docker-compose up using the docker-compose
		Docker start: sudo service docker start
		Access docker: docker exec -it bookworm-backend_db_1 bash

## RESTful APIs
---------
1. Use JSON
2. Use Nouns instead of Verbs:
GET /books/123

3. Name the collections using Plural Nouns:
 GET  /cars/123

4. Use resource nesting: /users/123/orders

5. Error Handling:

- HTTP Status Code
- Code ID
- Message
- The response as:
{
	"status": 404,
	"message": "Not found",
	"code": 00012
}

6. Filtering, sorting, paging, and field selection:

- GET /users?country=USA&creation_date=2019-11-11&sort=birthdate_date:desc&limit=100&offset=2
- GET /users/123?fields=username,email (for one specific user)

7. Versioning: https://api.stripe.com/v1/
8. API Documentation (Good API documentation examples):
- Twilio: https://www.twilio.com/docs/usage/api
- Stripe: https://stripe.com/docs/api
9. Using SSL/TLS:
Always use SSL/TLS to encrypt the communication with your API. No exceptions. Period.
11. Write Unit Test
12. Link reference:
- https://www.toptal.com/laravel/restful-laravel-api-tutorial


## Unit Testing (Testing JSON APIs)
-------
- https://www.twilio.com/blog/unit-testing-laravel-api-phpunit
- https://auth0.com/blog/testing-laravel-apis-with-phpunit/
- https://laravel.com/docs/8.x/http-tests#testing-json-apis
- https://sqlite.org/cli.html
- https://laravel.com/docs/8.x/http-tests
- https://blog.pusher.com/tests-laravel-applications (Following this Link)
- Issue: Should replace `PHPUnit\Framework\TestCase` to Tests\TestCase.

1. Setting up our testing environment:

- create an .env.testing file from .env and config for testing.

- Create new file database/database.sqlite.

- Migrate and seed the test database: php artisan migrate --seed --env=testing.

- CMD clear cache testing: php artisan config:cache --env=testing.

- Make order unit test: php artisan make:test OrderTest --unit.

- Run: php artisan test or run all "php artisan test".

2. Writing our test cases: For the e-commerce application, We will be testing all the API endpoints to ensure it actually works as expected. If we had observers or repositories that handled complex application logic, we may want to test them to ensure they work as expected.

- Testing the book endpoints: php artisan make:test BookTest --unit
3. Running the tests
- CMD: cd docker web and run $ ./vendor/bin/phpunit

