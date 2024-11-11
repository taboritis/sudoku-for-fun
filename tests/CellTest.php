<?php

declare(strict_types=1);

namespace Taboritis\Sutoku\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Taboritis\Sudoku\Cell;

#[CoversClass(Cell::class)]
class CellTest extends TestCase
{
    #[Test]
    public function it_is_null_by_default(): void
    {
        $cell = new Cell(1, 1);

        $this->assertThat(null, $this->equalTo($cell->getValue()));
    }

    #[Test]
    public function it_can_be_set(): void
    {
        $cell = new Cell(1, 1,);

        $cell->setValue(5);

        $this->assertThat(5, $this->equalTo($cell->getValue()));
    }

    #[Test]
    public function a_cell_has_a_coordinates(): void
    {
        $cell = new Cell(5, 3);

        $this->assertSame(5, $cell->getRow());
        $this->assertSame(3, $cell->getColumn());
    }

    #[Test]
    #[DataProvider('provideInvalidCoordinates')]
    public function it_throws_an_exception_for_outbound_value(int $row, int $column): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $cell = new Cell($row, $column);
    }

    public static function provideInvalidCoordinates(): \Generator
    {
        yield [0, 4];
        yield [5, 0];
        yield [5, 10];
        yield [10, 10];
    }

    #[Test]
    public function a_value_can_be_set_on_creating_a_cell(): void
    {
        $cell = new Cell(1, 1, 5);

        $this->assertSame(5, $cell->getValue());
    }

    #[Test, DataProvider('provideNumericPositionInSquare')]
    public function it_has_numeric_position_in_square(int $row, int $column, int $numericPositionInSquare): void
    {
        $cell = new Cell($row, $column);

        $this->assertEquals($numericPositionInSquare, $cell->numericPositionInSquare());
    }

    public static function provideNumericPositionInSquare(): \Generator
    {
        yield [1, 1, 1];
        yield [1, 3, 3];
        yield [1, 6, 3];
        yield [1, 9, 3];
        yield [2, 1, 4];
        yield [2, 2, 5];
        yield [3, 3, 9];
        yield [3, 3, 9];
        yield [5, 5, 5];
        yield [7, 7, 1];
        yield [9, 9, 9];
    }
}
