# Firecat
This is the main firecat repository for **firecat.io**

### Good To knows
- `master` branch for live site
- release/\<version> for Releases i.e **release/2.0.0**
    - Big number indicates which milestone, middle number is per feature
    release and small number is for bug fixes
- feature/\<feature name> for features i.e **feature/set-up-docker-compose**
- bugfix/\<bug name> for bug fixes i.e **bugfix/fix-docker-compose-files**

## Set up with Docker
To set up with docker you will need to perform the following steps.

* Firstly make sure your docker machine is running
* run `docker-compose up` if this is the first time building the containers.
* after the build command has run, you may cancel out and run `docker-compose start` to start up
the containers.
* To enter the container you will need to use one of the following commands:
    * `winpty docker exec -it firecat-php-fpm bash` (Windows)(Use Git Bash)
    * `docker exec -it firecat-php-fpm bash` (Mac/Linux)
* Once you are in you will want to run `composer install` and `cp .env.example .env`.
* You will also want to run `php artisan key:generate`.
* Run `apt-get update` and `apt-get install npm`.
* Next depends on if you are on Linux/Mac or Windows
    * (WINDOWS) `npm install --no-bin-links` && `npm install -g cross-env`
    * (MAC/LINUX) `npm install`
* Navigate to http://192.168.99.100:8080 to access the site.

_To run the scss watcher you will want to run `npm run watch-poll`._


## Subsequent Starts
Once you have already set up the repo, getting back into it is really simple

* Firstly make sure your docker machine is running.
* Next navigate to your repository and type `docker-compose start`
* Next use either of the following commands:
    * `winpty docker exec -it firecat-php-fpm bash` (Windows)(Use Git Bash)
    * `docker exec -it firecat-php-fpm bash` (Mac/Linux)
* Done!

_To run the scss watcher you will want to run `npm run watch-poll`._

## Useful commands

1. `php artisan make:migration <migration_name>` - Creates a new migration file
2. `php artisan migrate` - Migrates any outstanding migration files
3. `php artisan make:model <model_name>` - Creates a new model file
