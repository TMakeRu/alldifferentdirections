All Different Directions
====

## Overview

Test Solution for "All Different Directions".

## Description

[All Different Directions](https://open.kattis.com/problems/alldifferentdirections)

## Install

Clone this repository.

```bash
$ git clone https://github.com/TMakeRu/alldifferentdirections.git
```

## Usage

Up:

```bash
$ docker-compose up -d
$ docker exec -it alldifferentdirections bash
$ cd public && composer install
```
Run:

```bash
$ docker exec -it alldifferentdirections bash
$ ./public/index.php
```

Test:
```bash
$ docker-compose up -d
$ docker exec -it alldifferentdirections bash
$ ./public/vendor/bin/phpunit ./public/tests
```

Stop:

```bash
$ docker-compose stop
```

## Author

[Stepan](http://tmake.ru/)

