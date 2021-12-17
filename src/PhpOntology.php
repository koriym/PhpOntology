<?php

declare(strict_types=1);

namespace Koriym\PhpOntology;

use Generator;
use Koriym\Psr4List\Psr4List;
use ReflectionClass;

final class PhpOntology
{
    /**
     * @return Generator<DocClass>
     */
    public function __invoke(string $namespace, string $dir): Generator
    {
        $list = (new Psr4List())($namespace, $dir);
        foreach ($list as [$class, $file]) {
            yield new DocClass(new ReflectionClass($class));
        }
    }
}
