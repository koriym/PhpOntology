<?php

declare(strict_types=1);

namespace Koriym\PhpOntology;

use ReflectionParameter;

final class Parameter
{
    public string $name;

    public function __construct(ReflectionParameter $parameter)
    {
        $this->name = $parameter->getName();
    }
}
