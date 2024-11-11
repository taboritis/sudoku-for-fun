<?php

declare(strict_types=1);

namespace Taboritis\Sudoku\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Taboritis\Sudoku\Board;
use Taboritis\Sudoku\Cell;
use Taboritis\Sudoku\Column;
use Taboritis\Sudoku\Row;
use Taboritis\Sudoku\Square;

#[CoversClass(Board::class)]
class BoardTest extends TestCase
{
    #[Test]
    public function a_board_is_initialized_with_empty_cells(): void
    {
        $board = new Board();

        $this->assertCount(81, $board->getCells());
    }

    #[Test]
    public function it_can_return_column(): void
    {
        $board = new Board();
        $column = $board->getColumn(5);

        $this->assertInstanceOf(Column::class, $column);
    }

    #[Test]
    public function it_can_return_a_row(): void
    {
        $board = new Board();
        $row = $board->getRow(5);

        $this->assertInstanceOf(Row::class, $row);
    }

    #[Test]
    public function it_can_return_a_square(): void
    {
        $board = new Board();
        $square = $board->getSquare(5);

        $this->assertInstanceOf(Square::class, $square);
    }

    #[Test]
    public function it_can_return_a_specific_cell_by_coordinates(): void
    {
        $board = new Board();
        $coordinates = [
            'row' => random_int(1, 9),
            'column' => random_int(1, 9)
        ];

        $cell = $board->getCell($coordinates['row'], $coordinates['column']);

        $this->assertInstanceOf(Cell::class, $cell);

        $this->assertEquals($coordinates['row'], $cell->getRow());
        $this->assertEquals($coordinates['column'], $cell->getColumn());
    }

    #[Test]
    public function a_column_and_board_shares_the_same_cells(): void
    {
        $board = new Board();
        $coordinates = [
            'row' => random_int(1, 9),
            'column' => random_int(1, 9)
        ];
        $column = $board->getColumn($coordinates['column']);
        $cell = $board->getCell($coordinates['row'], $coordinates['column']);
        $cell->setValue(random_int(1, 9));

        $this->assertSame($cell, $theSameCell = $column->getCell($coordinates['row']));
        $this->assertSame($cell->getValue(), $theSameCell->getValue());
    }

    #[Test]
    public function it_can_be_displayed_as_array(): void
    {
        $board = new Board();
        $array = $board->toArray();

        $this->assertIsArray($array);

        $this->assertCount(9, $array);
    }
}
