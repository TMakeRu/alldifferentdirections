All Different Directions
====

## Overview

[![Build Status](https://travis-ci.org/TMakeRu/alldifferentdirections.svg?branch=master)](https://travis-ci.org/TMakeRu/alldifferentdirections)

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
$ composer install
$ docker-compose up -d
$ docker exec -it alldifferentdirections bash
```
Run:

```bash
$ docker exec -it alldifferentdirections bash
$ ./index.php
```

Test:
```bash
$ docker-compose up -d
$ docker exec -it alldifferentdirections bash
$ ./vendor/bin/phpunit ./tests
```

Stop:

```bash
$ docker-compose stop
```

## Author

[Stepan](http://tmake.ru/)

