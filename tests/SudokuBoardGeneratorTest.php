<?php

declare(strict_types=1);

namespace Taboritis\Sudoku\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Taboritis\Sudoku\Board;
use Taboritis\Sudoku\SudokuBoardGenerator;

#[CoversClass(SudokuBoardGenerator::class)]
class SudokuBoardGeneratorTest extends TestCase
{
    #[Test]
    public function it_can_create_a_board(): void
    {
        $board = SudokuBoardGenerator::generate();

        $this->assertInstanceOf(Board::class, $board);
    }

    #[Test]
    public function all_cells_has_a_values(): void
    {
        $board = SudokuBoardGenerator::generate();
        $cell = $board->getCell(random_int(1, 9), random_int(1, 9));

        $this->assertNotEquals(0, $cell->getValue());
    }
}
