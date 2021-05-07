<?php

declare(strict_types=1);

namespace Koriym\PhpOntology;

use ArrayObject;
use ReflectionNamedType;
use ReflectionParameter;

use function is_array;
use function str_replace;
use function strtolower;
use function var_export;

use const PHP_EOL;

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

    /** @readonly */
    public string $default;

    /** @var ArrayObject<string, string> */
    private ArrayObject $semanticDictionary;

    public function __construct(
        ReflectionParameter $parameter,
        TagParam $tagParam,
    ) {
        $this->name = $parameter->name;
        $this->type = $this->getType($parameter);
        $this->isOptional = $parameter->isOptional();
        $this->default = $parameter->isDefaultValueAvailable() ? $this->getDefaultString($parameter) : '';
        $this->description = $tagParam->description;
        /** @psalm-suppress MixedPropertyTypeCoercion */
        $this->semanticDictionary = new ArrayObject();
    }

    private function getType(ReflectionParameter $parameter): string
    {
        $namedType = $parameter->getType();
        if (! $namedType instanceof ReflectionNamedType) {
            return '';
        }

        return $namedType->getName();
    }

    private function getDefaultString(ReflectionParameter $parameter): string
    {
        /** @var array<mixed>|bool|int|float|string $default */
        $default = $parameter->getDefaultValue();
        if (is_array($default)) {
            return str_replace(PHP_EOL, '', strtolower(var_export($default, true)));
        }

        $stringDefault = (string) $default;
        if ($stringDefault) {
            return $stringDefault;
        }

        return $this->semanticDictionary[$parameter->name] ?? '';
    }
}
