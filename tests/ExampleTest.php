<?php

declare(strict_types=1);

namespace Taboritis\PhpPackageBlueprint\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Taboritis\PhpPackageBlueprint\Cell;

#[CoversClass(Cell::class)]
class ExampleTest extends TestCase
{
    #[Test]
    public function it_return_true(): void
    {
        $example = new Cell();

        $this->assertTrue($example->alwaysTrue());
    }
}
