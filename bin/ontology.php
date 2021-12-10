#!/usr/bin/env php
<?php

use Koriym\PhpOntology\DocParam;
use Koriym\PhpOntology\PhpOntology;

require dirname(__DIR__) . '/vendor/autoload.php';
$namespace = 'Koriym\PhpOntology';
$dir =  dirname(__DIR__) . '/tests/Fake';

foreach ([dirname(__DIR__, 3) . '/autoload.php',dirname( __DIR__) . '/vendor/autoload.php'] as $file) {
    if (file_exists($file)) {
        require $file;
        break;
    }
}

init:
//    if ($argc !== 2) {
//        echo 'usage: ontology <dir>' . PHP_EOL;
//        exit(1);
//    }
//    [, $dir] = $argv;

main:
    $phpOntology = (new PhpOntology())($namespace, $dir);
    $terms = [];
    foreach ($phpOntology as $class) {
        $methods = $class();
        foreach ($methods as $method) {
            foreach ($method->params as $param) {
                assert($param instanceof DocParam);
                $terms[$param->name][] = $param->description;
            }
        }
    }
    ksort($terms);
    foreach($terms as $name => $descriptions) {
        $description = implode(', ', $descriptions);
        echo sprintf('%s: %s', $name, $description) . PHP_EOL;
    }
