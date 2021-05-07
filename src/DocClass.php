<?php

declare(strict_types=1);

namespace Koriym\PhpOntology;

use Generator;
use ReflectionClass;

final class DocClass
{
    /** @param ReflectionClass<object> $class */
    public function __construct(private ReflectionClass $class)
    {
    }

    /**
     * @return Generator<DocMethod>
     */
    public function __invoke(): Generator
    {
        $methods = $this->class->getMethods();
        foreach ($methods as $method) {
            yield new DocMethod($method);
        }
    }
}
