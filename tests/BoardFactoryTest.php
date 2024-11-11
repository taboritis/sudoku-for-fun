<?php

declare(strict_types=1);

namespace Taboritis\Sudoku\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Taboritis\Sudoku\Board;
use Taboritis\Sudoku\BoardFactory;

#[CoversClass(BoardFactory::class)]
class BoardFactoryTest extends TestCase
{

    #[Test]
    public function it_can_create_a_board(): void
    {
        $board = BoardFactory::generate();

        $this->assertInstanceOf(Board::class, $board);
    }

    #[Test]
    public function all_cells_has_a_values(): void
    {
        $board = BoardFactory::generate();
        $cell = $board->getCell(random_int(1, 9), random_int(1, 9));

        $this->assertNotEquals(0, $cell->getValue());
    }
}
