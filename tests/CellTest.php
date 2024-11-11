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

    #[Test, DataProvider('squareNumberConventionDataProvider')]
    public function a_cell_knows_a_square_where_he_is(int $expectedSquare, array $coordinates): void
    {
        $randomCoordinates = $coordinates[array_rand($coordinates)];
        $cell = new Cell($randomCoordinates[0], $randomCoordinates[1]);

        $this->assertEquals($expectedSquare, $cell->squareNumber());
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

    public static function squareNumberConventionDataProvider(): \Generator
    {
        yield [1, [[1, 1], [1, 2], [1, 3], [2, 1], [2, 2], [2, 3], [3, 1], [3, 2], [3, 3]]];
        yield [2, [[1, 4], [1, 5], [1, 6], [2, 4], [2, 5], [2, 6], [3, 4], [3, 5], [3, 6]]];
        yield [3, [[1, 7], [1, 8], [1, 9], [2, 7], [2, 8], [2, 9], [3, 7], [3, 8], [3, 9]]];
        yield [4, [[4, 1], [4, 2], [4, 3], [5, 1], [5, 2], [5, 3], [6, 1], [6, 2], [6, 3]]];
        yield [5, [[4, 4], [4, 5], [4, 6], [5, 4], [5, 5], [5, 6], [6, 4], [6, 5], [6, 6]]];
        yield [6, [[4, 7], [4, 8], [4, 9], [5, 7], [5, 8], [5, 9], [6, 7], [6, 8], [6, 9]]];
        yield [7, [[7, 1], [7, 2], [7, 3], [8, 1], [8, 2], [8, 3], [9, 1], [9, 2], [9, 3]]];
        yield [8, [[7, 4], [7, 5], [7, 6], [8, 4], [8, 5], [8, 6], [9, 4], [9, 5], [9, 6]]];
        yield [9, [[7, 7], [7, 8], [7, 9], [8, 7], [8, 8], [8, 9], [9, 7], [9, 8], [9, 9]]];
    }
}
