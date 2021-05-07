# PhpOntology

Read the words used in arguments, methods, etc. from the source code.

## Installation

    composer install

## Usage

See [demo](docs/demo.php].

```php
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
```
