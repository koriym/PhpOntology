<?php

declare(strict_types=1);

namespace Koriym\PhpOntology;

use PHPUnit\Framework\TestCase;

class PhpOntologyTest extends TestCase
{
    protected PhpOntology $phpOntology;

    protected function setUp(): void
    {
        $this->phpOntology = new PhpOntology();
    }

    public function testIsInstanceOfPhpOntology(): void
    {
        $actual = $this->phpOntology;
        $this->assertInstanceOf(PhpOntology::class, $actual);
    }

    public function testInvoke(): void
    {
        $phpOntology = ($this->phpOntology)('Koriym\PhpOntology', __DIR__ . '/Fake');
        foreach ($phpOntology as $class) {
            $classes = $class();
            foreach ($classes as $method) {
                $this->assertInstanceOf(DocMethod::class, $method);
                foreach ($method->params as $param) {
                    $this->assertInstanceOf(DocParam::class, $param);
                }
            }
        }
    }
}
