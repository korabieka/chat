# Requirements

Assume that you don't have php7,sqlite and nginx on your machine

1- install docker for your OS .

2- install composer .

# Install instructions
 
1- run the following commands for docker `cd docker` then `sudo docker-compose up`

2- `sudo docker ps` to check if our images are up or not

3- Open docker container

`docker exec -it docker_php7_fpm_1 /bin/bash`

4- run `composer install`

5- copy the .env.example file and rename the copied one to .env

6- run `php artisan key:generate`

5- open the following link : `http://localhost:8081` (it will start the chat application)

# Travis Badge

[![Build Status](https://travis-ci.org/korabieka/TajawalTask.svg?branch=master)](https://travis-ci.org/korabieka/TajawalTask)

# Codeclimate Badge for maintainability

[![Maintainability](https://api.codeclimate.com/v1/badges/972e14cd6011c6f0097b/maintainability)](https://codeclimate.com/github/korabieka/TajawalTask/maintainability)
