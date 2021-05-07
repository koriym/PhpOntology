<?php

use Koriym\PhpOntology\DocMethod;
use Koriym\PhpOntology\DocParam;
use Koriym\PhpOntology\PhpOntology;

$autoload = require dirname(__DIR__) . '/vendor/autoload.php';
assert($autoload instanceof Composer\Autoload\ClassLoader);
$autoload->addPsr4('Koriym\\PhpOntology\\', __DIR__ . '/Fake');
$phpOntology = (new PhpOntology())('Koriym\PhpOntology', __DIR__ . '/Fake');
foreach ($phpOntology as $class) {
    $classes = $class();
    foreach ($classes as $method) {
        assert($method instanceof DocMethod);
        printf("Method name: title:%s type:%s desc:%s\n", $method->name, $method->title, $method->description);
        foreach ($method->params as $param) {
            assert($param instanceof DocParam);
            printf("Param: name:%s type:%s desc:%s\n", $param->name, $param->type, $param->description);
        }
    }
}
