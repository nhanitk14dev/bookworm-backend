# Overview Bookworm Backend
Bookworm site using the Laravel v8.0 framework to build a backend system that provides API endpoints.


#Install Laravel
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

#Build Docker
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