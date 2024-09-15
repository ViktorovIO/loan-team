DOCKER_COMPOSE = docker-compose --env-file .env.local

#############################
# DOCKER COMPOSE OPERATIONS #
#############################

env:
	cp .env .env.local

up:
	${DOCKER_COMPOSE} up -d

up-build:
	${DOCKER_COMPOSE} up -d --build

down:
	${DOCKER_COMPOSE} down

restart:
	${DOCKER_COMPOSE} restart


###############
# APPLICATION #
###############

php:
	${DOCKER_COMPOSE} exec -u www-data php-fpm bash

composer:
	${DOCKER_COMPOSE} exec -u www-data php-fpm composer install

cache-clear:
	${DOCKER_COMPOSE} exec -u www-data php-fpm php bin/console cache:clear

rebuild: cache-clear down up

############
# DATABASE #
############

new-migration:
	${DOCKER_COMPOSE} exec -u www-data php-fpm php bin/console make:migration

migrate:
	${DOCKER_COMPOSE} exec -u www-data php-fpm php bin/console d:m:m