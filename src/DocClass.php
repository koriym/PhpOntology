<?php

declare(strict_types=1);

namespace Koriym\PhpOntology;

use Generator;
use ReflectionClass;

final class DocClass
{
    /** @var ReflectionClass */
    private ReflectionClass $class;

    /** @param ReflectionClass<object> $class */
    public function __construct(ReflectionClass $class)
    {
        $this->class = $class;
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
