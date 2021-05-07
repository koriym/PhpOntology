<?php

declare(strict_types=1);

namespace Koriym\PhpOntology;

use PHPUnit\Framework\TestCase;
use ReflectionMethod;

class DocMethodTest extends TestCase
{
    public function testNewInstance(): void
    {
        $method = new DocMethod(new ReflectionMethod(FakeClass::class, 'method'));
        $this->assertSame('Title of fake class', $method->title);
    }
}
