#!/usr/bin/env php
<?php
/**
 * All Different Directions
 *
 * @link       https://open.kattis.com/problems/alldifferentdirections
 */

require_once __DIR__ . '/vendor/autoload.php';

use App\Handler;

function dd(...$dump) {
    var_dump($dump); exit;
}

new Handler();
