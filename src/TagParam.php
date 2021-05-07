<?php

declare(strict_types=1);

namespace Koriym\PhpOntology;

final class TagParam
{
    /** @readonly */
    public string $type = '';

    /** @readonly */
    public string $description = '';

    public function __construct(string $type, string $description)
    {
        $this->type = $type;
        $this->description = $description;
    }
}
