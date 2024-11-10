<?php

declare(strict_types=1);

namespace Taboritis\Sutoku\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Taboritis\Sudoku\Cell;

#[CoversClass(Cell::class)]
class CellTest extends TestCase
{

    #[Test]
    public function it_is_null_by_default(): void
    {
        $cell = new Cell();

        $this->assertThat(null, $this->equalTo($cell->getValue()));
    }

    #[Test]
    public function it_can_be_set(): void
    {
        $cell = new Cell();

        $cell->setValue(5);

        $this->assertThat(5, $this->equalTo($cell->getValue()));
    }
}
