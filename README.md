![Symfony Docker Demo](/banner.png)

Symfony Docker Demo
===================

## Installation
First, you have to clone this repository.

```bash
$ git clone https://github.com/AlexBa/Symfony-Docker-Demo.git
```

Then, you have to set up your docker container with docker-compose.

```bash
$ docker-compose up
```

## Custom Parameters
You can put your custom development parameters into the file config/env/dev.env. 

```bash
APP_CACHE_DIR=/tmp/cache
APP_LOG_DIR=/var/log/apache2
APP_RUN_MODE=dev
SYMFONY__LOCALE=en
SYMFONY__SECRET=ThisShouldBeYourSecretToken
SYMFONY__REDIS_HOST=redis
```