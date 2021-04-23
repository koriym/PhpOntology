<?php

declare(strict_types=1);

namespace Koriym\PhpOntology;

use PHPUnit\Framework\TestCase;

class PhpOntologyTest extends TestCase
{
    /** @var PhpOntology */
    protected $phpOntology;

    protected function setUp(): void
    {
        $this->phpOntology = new PhpOntology();
    }

    public function testIsInstanceOfPhpOntology(): void
    {
        $actual = $this->phpOntology;
        $this->assertInstanceOf(PhpOntology::class, $actual);
    }
}
