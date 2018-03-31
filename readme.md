# Requirements

Assume that you don't have php7 and nginx on your machine

1- Install docker and docker compose for your OS .

2- Install composer .

# Install instructions
 
1- Run the following commands for docker `cd docker` then `sudo docker-compose up`

2- `sudo docker ps` to check if our images are up or not

3- Open docker container

`docker exec -it docker_php7_fpm_1 /bin/bash`

4- Run `composer install`

5- Copy the .env.example file and rename the copied one to .env

6- Run `php artisan key:generate`

7- Run `php artisan migrate`

8- Open the following link : `http://localhost:8081` (it will start the chat application)

9- Don't forget to test from different browsers.

# Travis Badge

[![Build Status](https://travis-ci.org/korabieka/TajawalTask.svg?branch=master)](https://travis-ci.org/korabieka/TajawalTask)

# Codeclimate Badge for maintainability

[![Maintainability](https://api.codeclimate.com/v1/badges/9bb021c3f16349a0c72f/maintainability)](https://codeclimate.com/github/korabieka/chat/maintainability)
