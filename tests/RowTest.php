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

    #[Test]
    public function it_has_a_number(): void
    {
        $cells = [
            new Cell(5, 1),
            new Cell(5, 2),
            new Cell(5, 3),
            new Cell(5, 4),
            new Cell(5, 5),
            new Cell(5, 6),
            new Cell(5, 7),
            new Cell(5, 8),
            new Cell(5, 9)
        ];

        $column = new Row($cells);

        $this->assertThat(5, $this->equalTo($column->getRowNumber()));
    }

    #[Test]
    public function it_has_a_cells(): void
    {
        $cells = [
            new Cell(5, 1),
            new Cell(5, 2),
            new Cell(5, 3),
            new Cell(5, 4),
            new Cell(5, 5),
            new Cell(5, 6),
            new Cell(5, 7),
            new Cell(5, 8),
            new Cell(5, 9)
        ];

        $column = new Row($cells);
        $cell = $column->getCell(8);

        $this->assertInstanceOf(Cell::class, $cell);
        $this->assertEquals(8, $cell->getColumn());
        $this->assertEquals(5, $cell->getRow());
    }

    #[Test]
    public function a_row_has_9_cells(): void
    {
        $cells = [
            new Cell(5, 1),
            new Cell(5, 2),
            new Cell(5, 3),
            new Cell(5, 4),
            new Cell(5, 5),
            new Cell(5, 6),
            new Cell(5, 7),
            new Cell(5, 8),
            new Cell(5, 9)
        ];

        $column = new Row($cells);

        $this->assertCount(9, $column->getCells());
    }

    #[Test]
    public function it_not_possible_to_create_row_with_cells_from_different_rows(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $cells = [
            new Cell(5, 1),
            new Cell(5, 2),
            new Cell(5, 3),
            new Cell(5, 4),
            new Cell(5, 5),
            new Cell(5, 6),
            new Cell(5, 7),
            new Cell(5, 8),
            new Cell(6, 9)
        ];

        new Row($cells);
    }

    #[Test]
    public function it_is_not_possible_to_create_row_with_duplicated_coordinates(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $cells = [
            new Cell(5, 1),
            new Cell(5, 1),
            new Cell(5, 3),
            new Cell(5, 4),
            new Cell(5, 5),
            new Cell(5, 6),
            new Cell(5, 7),
            new Cell(5, 8),
            new Cell(5, 9)
        ];

        new Row($cells);
    }
}
