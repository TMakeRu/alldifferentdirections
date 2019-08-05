#!/usr/bin/env php
<?php
/**
 * All Different Directions
 *
 * @link       https://open.kattis.com/problems/alldifferentdirections
 * @author     Barannikov Stepan
 * @link       http://tmake.ru/
 */

require_once __DIR__ . '/vendor/autoload.php';

use App\Handler;

function dd(...$dump) {
    var_dump($dump); exit;
}

new Handler();