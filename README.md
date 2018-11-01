## Running with xamp/wamp
* install composer follow this [guide](https://freetuts.net/composer-la-gi-695.html)
* install *xamp/ wamp* 
* Should restart your PC after installing above
* Copy project's source to **www (wamp)/ htdocs (xamp)**
* Start wamp/xamp
* ```cd ``` to project and run ```composer install``` to get vendor
* Run ```php artisan serve```
* Copy file **.env.example** to **.env**
* import database to phpmyadmin by this url http://localhost/phpmyadmin
* Go to URL ```http://localhost/[ten thu muc]/public/```


## Running with Docker

### Installing Docker
- Ubuntu:
* Follow [the official guide](https://docs.docker.com/engine/installation/linux/docker-ce/ubuntu/#install-docker-ce) to install Docker CE for Ubuntu
* Follow [the official guide](https://docs.docker.com/engine/installation/linux/linux-postinstall/) to run Docker as a non-root user
* Follow [the official guide](https://docs.docker.com/compose/install/) to install Docker Compose for Ubuntu

- Windows:
* Follow [the official guide](https://docs.docker.com/toolbox/toolbox_install_windows/) to install Docker for Windows

### Configuring the application

* change volumes mapping from ```/var/www/dotnet:/app``` to your desired path
* once you install Docker, you can start the containers using the Docker Compose

```sh
$ docker-compose up -d (Linux)
```
Start Docker Quickstart application on Window

Cd to project path run below command:
```sh
$ cp .env.example .env
$ docker ps
```


You should be able to visit the application at [http://localhost:8082](http://localhost:8082).

## Important Commands (Dont need to care now)

* run ```npm run watch``` and keep that terminal open to watch all relevant files for changes
* run ```composer check-name``` to check naming conventions
* run ```composer cs-check``` to check your code (one by one) to follow standards
* run ```composer cs-check-all``` to check your code (all) to follow standards
* run ```composer cs-fix``` to fix your code (one by one) to follow standards
* ```composer dumpautoload```
* ```php artisan cache:clear```
* ```php artisan view:clear```
* ```php artisan config:clear```
* ```php artisan route:clear```
* ```php artisan clear-compiled```
* ```php artisan route:list```

## Update vendors
Run ```composer install``` or to get vendor
```composer update``` to update vendor to latest

When update vendors, remember to:

* copy [/vendor/nwidart/laravel-modules/config/config.php] to [/config/modules.php]
