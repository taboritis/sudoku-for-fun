<?php

declare(strict_types=1);

namespace Taboritis\Sudoku\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Taboritis\Sudoku\Cell;
use Taboritis\Sudoku\Row;

#[CoversClass(Row::class)]
class RowTest extends TestCase
{
    #[Test]
    public function it_has_9_cells(): void
    {
        $cells = [
            new Cell(1, 1),
            new Cell(1, 2),
            new Cell(1, 3),
            new Cell(1, 4),
            new Cell(1, 5),
            new Cell(1, 6),
            new Cell(1, 7),
            new Cell(1, 8),
            new Cell(1, 9)
        ];
        $row = new Row($cells);

        $this->assertCount(9, $row->getCells());
    }
}
