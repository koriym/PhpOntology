<?php

declare(strict_types=1);

namespace Koriym\PhpOntology;

use Generator;
use Koriym\Psr4List\Psr4List;
use ReflectionClass;

use function assert;
use function class_exists;

final class PhpOntology
{
    /**
     * @return Generator<DocClass>
     */
    public function __invoke(string $namespace, string $dir): Generator
    {
        $list = (new Psr4List())($namespace, $dir);
        foreach ($list as [$class]) {
            assert(class_exists($class));

            yield new DocClass(new ReflectionClass($class));
        }
    }
}
