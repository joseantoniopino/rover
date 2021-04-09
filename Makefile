#!/bin/bash

OS = $(shell uname)
UID = $(shell id -u)
DOCKER_BE = service-rover-be
NAMESERVER_IP = $(shell ip address | grep docker0)

ifeq ($(OS),Darwin)
	NAMESERVER_IP = host.docker.internal
else ifeq ($(NAMESERVER_IP),)
	NAMESERVER_IP = $(shell grep nameserver /etc/resolv.conf  | cut -d ' ' -f2)
else
	NAMESERVER_IP = 172.17.0.1 # replace this IP with your "docker0" one (run "ip a" in your terminal to check it)
endif

help: ## Show this help message
	@echo 'usage: make [target]'
	@echo
	@echo 'targets:'
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'

start: ## Start the containers
	docker network create service-rover-net || true
	U_ID=${UID} docker-compose up -d

stop: ## Stop the containers
	U_ID=${UID} docker-compose stop

restart: ## Restart the containers
	$(MAKE) stop && $(MAKE) start

build: ## Rebuilds all the containers
	docker network create service-rover-net || true
	U_ID=${UID} docker-compose build

prepare: ## Runs backend commands
	$(MAKE) composer-install

composer-install: ## Installs composer dependencies
	U_ID=${UID} docker exec --user ${UID} ${DOCKER_BE} composer install --no-interaction

ssh-be: ## bash into the be container
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} bash


