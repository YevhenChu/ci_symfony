# Makefile for Docker Nginx PHP Composer MySQL

include .env

# MySQL
MYSQL_DUMPS_DIR=data/db/dumps


.DEFAULT_GOAL=help

WWW_USER_ID=${id -u}
PHP_CONTAINER=$(shell docker compose ps -q php 2> /dev/null)
MYSQL_CONTAINER=$(shell docker compose ps -q mysqldb 2> /dev/null)

help:
	@echo ""
	@echo "usage: make COMMAND"
	@echo ""
	@echo "Commands:"
	@echo "  init 	              Install the project"
	@echo "  start 	      Start the docker containers"
	@echo "  down 	      	      Stop the docker server and remove containers"
	@echo "  build 	      Rebuild the containers"
	@echo "  clean               Clean directories for reset"
	@echo "  composer            Install composer dependencies"
	@echo "  logs                Follow log output"
	@echo "  mysql-dump          Create backup of all databases"
	@echo "  mysql-restore       Restore backup of all databases"
	@echo "  test                Run test suit"

init:
	@make -s build
	@make -s start

symfony-install:
	@docker exec -it ${PHP_CONTAINER} bash -c 'composer create-project symfony/skeleton:"6.4.*" .'
	@make -s composer
#	rsync --ignore-existing web/.env.example web/.env
	@docker exec -it ${PHP_CONTAINER} bash -c "composer require doctrine"
	@docker exec -it ${PHP_CONTAINER} bash -c "composer require symfony/serializer"
	@docker exec -it ${PHP_CONTAINER} bash -c "composer require symfony/property-access"
	@docker exec -it ${PHP_CONTAINER} bash -c "composer require --dev phpstan/phpstan"
#	@docker exec -it ${PHP_CONTAINER} bash -c "composer require nunomaduro/phpinsights --dev"
	@docker exec -it ${PHP_CONTAINER} bash -c "composer require --dev friendsofphp/php-cs-fixer"
	@docker exec -it ${PHP_CONTAINER} bash -c "composer require rector/rector --dev"
	@docker exec -it ${PHP_CONTAINER} bash -c "composer require --dev phpunit/phpunit symfony/test-pack"
	@docker exec -it ${PHP_CONTAINER} bash -c "composer require doctrine/orm doctrine/doctrine-bundle"
	@docker exec -it ${PHP_CONTAINER} bash -c "composer require --dev dama/doctrine-test-bundle"
	@docker exec -it ${PHP_CONTAINER} bash -c "composer require --dev helmich/phpunit-json-assert"

start:
	@WWW_USER_ID=${WWW_USER_ID} docker compose up --pull missing --remove-orphans -d

down:
	@docker compose down

build:
	@WWW_USER_ID=${WWW_USER_ID} docker compose --profile test build --parallel


clean:
	@rm -Rf data/db/mysql/*
	@rm -Rf $(MYSQL_DUMPS_DIR)/*
	@rm -Rf app/vendor
	@rm -Rf app/composer.lock
	@rm -Rf app/doc
	@rm -Rf app/report
	@rm -Rf ssl/*

composer:
	@docker exec -it ${PHP_CONTAINER} bash -c "composer install"

logs:
	@docker-compose logs -f

test:
	@docker compose run php bash -c "composer test"

test-coverage:
	@docker compose run php bash -c "composer test-coverage"
	
.PHONY: fix
fix: ## Run php-cs-fixer
	@docker exec -it ${PHP_CONTAINER} bash -c "vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php --diff -v --show-progress=none"

rector: ## Run rector in dry-run mode
	@docker exec -it ${PHP_CONTAINER} bash -c "composer rector"

run-rector: ## Run rector process
	@docker exec -it ${PHP_CONTAINER} bash -c "vendor/bin/rector process --config rector.php"

phpstan: ## Run phpstan
	@docker exec -it ${PHP_CONTAINER} bash -c "composer phpstan"

insights: ## Run insights
	@docker compose run --user ${WWW_USER_ID} --rm composer /bin/sh -c "composer insights"

