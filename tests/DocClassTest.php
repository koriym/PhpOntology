<?php

declare(strict_types=1);

namespace Koriym\PhpOntology;

use PHPUnit\Framework\TestCase;
use ReflectionClass;

class DocClassTest extends TestCase
{
    public function testNewInstance(): void
    {
        $class = new DocClass(new ReflectionClass(FakeClass::class));
        $classGen = $class();
        foreach ($classGen as $method) {
            $this->assertInstanceOf(DocMethod::class, $method);
        }
    }
}
