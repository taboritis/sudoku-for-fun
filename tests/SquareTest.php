<?php

declare(strict_types=1);

namespace Taboritis\Sudoku\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Taboritis\Sudoku\Cell;
use Taboritis\Sudoku\Row;
use Taboritis\Sudoku\Square;

#[CoversClass(Square::class)]
class SquareTest extends TestCase
{
    #[Test]
    public function it_has_9_cells(): void
    {
        $cells = [
            new Cell(1, 1),
            new Cell(1, 2),
            new Cell(2, 3),
            new Cell(2, 1),
            new Cell(2, 2),
            new Cell(2, 3),
            new Cell(3, 1),
            new Cell(3, 2),
            new Cell(3, 3)
        ];
        $row = new Square($cells);

        $this->assertCount(9, $row->getCells());
    }

    #[Test, DataProvider('squareNumberConventionDataProvider')]
    public function it_has_a_number(int $expectedSquareNumber, array $coordinates): void
    {
        $cells = array_map(fn($coordinate) => new Cell(row: $coordinate[0], column: $coordinate[1]), $coordinates);
        $column = new Square($cells);

        $this->assertEquals($expectedSquareNumber, $column->getSquareNumber());
    }

    #[Test, DataProvider('squareCellCoordinatesProvider')]
    public function it_has_a_cells(int $expectedRow, int $expectedColumn, int $squareCellNumber): void
    {
        $cells = [
            new Cell(1, 1),
            new Cell(1, 2),
            new Cell(1, 3),
            new Cell(2, 1),
            new Cell(2, 2),
            new Cell(2, 3),
            new Cell(3, 1),
            new Cell(3, 2),
            new Cell(3, 3)
        ];
        $row = new Square($cells);

        $cell = $row->getCell(['row' => $expectedRow, 'column' => $expectedColumn]);

        $this->assertInstanceOf(Cell::class, $cell);
        $this->assertEquals($expectedColumn, $cell->getColumn());
        $this->assertEquals($expectedRow, $cell->getRow());
        $this->assertEquals($squareCellNumber, $cell->numericPositionInSquare());
    }

    #[Test]
    public function a_row_has_9_cells(): void
    {
        $this->markTestIncomplete();
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
        $this->markTestIncomplete();
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
        $this->markTestIncomplete();
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

    public static function squareCellCoordinatesProvider(): \Generator
    {
        yield [1, 1, 1];
        yield [1, 2, 2];
        yield [1, 3, 3];
        yield [2, 1, 4];
        yield [2, 2, 5];
        yield [2, 3, 6];
        yield [3, 1, 7];
        yield [3, 2, 8];
        yield [3, 3, 9];
    }
}
