<?php

declare(strict_types=1);

namespace Taboritis\Sudoku\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Taboritis\Sudoku\Cell;
use Taboritis\Sudoku\Column;

#[CoversClass(Column::class)]
class ColumnTest extends TestCase
{
    #[Test]
    public function it_has_a_number(): void
    {
        $cells = [
            new Cell(1, 5),
            new Cell(2, 5),
            new Cell(3, 5),
            new Cell(4, 5),
            new Cell(5, 5),
            new Cell(6, 5),
            new Cell(7, 5),
            new Cell(8, 5),
            new Cell(9, 5)
        ];

        $column = new Column($cells);

        $this->assertThat(5, $this->equalTo($column->getColumnNumber()));
    }

    #[Test]
    public function it_has_a_cells(): void
    {
        $cells = [
            new Cell(1, 5),
            new Cell(2, 5),
            new Cell(3, 5),
            new Cell(4, 5),
            new Cell(5, 5),
            new Cell(6, 5),
            new Cell(7, 5),
            new Cell(8, 5),
            new Cell(9, 5)
        ];

        $column = new Column($cells);
        $cell = $column->getCell(8);

        $this->assertInstanceOf(Cell::class, $cell);
        $this->assertEquals(5, $cell->getColumn());
        $this->assertEquals(8, $cell->getRow());
    }

    #[Test]
    public function a_column_has_9_cells(): void
    {
        $cells = [
            new Cell(1, 5),
            new Cell(2, 5),
            new Cell(3, 5),
            new Cell(4, 5),
            new Cell(5, 5),
            new Cell(6, 5),
            new Cell(7, 5),
            new Cell(8, 5),
            new Cell(9, 5)
        ];

        $column = new Column($cells);

        $this->assertCount(9, $column->getCells());
    }

    #[Test]
    public function it_not_possible_to_create_column_with_cells_from_different_columns(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $cells = [
            new Cell(1, 5),
            new Cell(2, 5),
            new Cell(3, 5),
            new Cell(4, 5),
            new Cell(5, 5),
            new Cell(6, 5),
            new Cell(7, 5),
            new Cell(8, 5),
            new Cell(9, 6)
        ];

        new Column($cells);
    }

    #[Test]
    public function it_is_not_possible_to_create_columns_with_duplicated_rows(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $cells = [
            new Cell(1, 5),
            new Cell(1, 5),
            new Cell(3, 5),
            new Cell(4, 5),
            new Cell(5, 5),
            new Cell(6, 5),
            new Cell(7, 5),
            new Cell(8, 5),
            new Cell(9, 5)
        ];

        new Column($cells);
    }

    #[Test]
    public function a_column_must_have_a_9_cells(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $cells = [
            new Cell(1, 5),
            new Cell(2, 5),
            new Cell(3, 5),
            new Cell(4, 5),
            new Cell(5, 5),
            new Cell(6, 5),
            new Cell(7, 5),
            new Cell(8, 5)
        ];
        new Column($cells);
    }

    #[Test]
    public function a_column_can_have_a_value(): void
    {
        $cells = [
            new Cell(1, 5),
            new Cell(2, 5),
            new Cell(3, 5),
            new Cell(4, 5),
            new Cell(5, 5),
            new Cell(6, 5),
            new Cell(7, 5),
            new Cell(8, 5),
            new Cell(9, 5)
        ];

        $column = new Column($cells);

        $this->assertFalse($column->hasValue(5));

        $column->getCell(4)->setValue(5);

        $this->assertTrue($column->hasValue(5));
    }
}
