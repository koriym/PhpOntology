<?php

declare(strict_types=1);

namespace Koriym\PhpOntology;

use ReflectionNamedType;
use ReflectionParameter;

final class DocParam
{
    /** @readonly */
    public string $name;

    /** @readonly */
    public string $type;

    /** @readonly */
    public string $description;

    /** @readonly */
    public bool $isOptional;

    public function __construct(
        ReflectionParameter $parameter,
        TagParam $tagParam
    ) {
        $this->name = $parameter->name;
        $this->type = $this->getType($parameter);
        $this->isOptional = $parameter->isOptional();
        $this->description = $tagParam->description;
        /** @psalm-suppress MixedPropertyTypeCoercion */
    }

    private function getType(ReflectionParameter $parameter): string
    {
        $namedType = $parameter->getType();
        if (! $namedType instanceof ReflectionNamedType) {
            return '';
        }

        return $namedType->getName();
    }
}
