<?php

declare(strict_types=1);

namespace Taboritis\Sudoku;

class Square
{
    /**@var Cell[] */
    private array $cells;

    /**
     * @param Cell[] $cells
     */
    public function __construct(array $cells)
    {
        $xcells = [];

        foreach ($cells as $cell) {
            $xcells[$cell->numericPositionInSquare()] = $cell;
        }

        if (count($xcells) !== 9) {
            throw new \InvalidArgumentException('Square must have 9 cells');
        }

        $squares = array_map(fn($cell) => $cell->squareNumber(), $cells);

        if (count(array_unique($squares)) !== 1) {
            throw new \InvalidArgumentException('Cells must be in the same square');
        }

        $this->cells = $cells;
    }

    /**
     * @return Cell[]
     */
    public function getCells(): array
    {
        return $this->cells;
    }

    public function getSquareNumber(): int
    {
        $squareRow = (int)ceil($this->cells[0]->getRow() - 1) / 3;
        $column = (int)floor($this->cells[0]->getColumn() / 3) + 1;

        return $squareRow * 3 + $column;
    }

    /**
     * @param array $coordinates {row:int, column:int}
     * @return Cell
     */
    public function getCell(array $coordinates)
    {
        foreach ($this->cells as $cell) {
            if ($cell->getRow() === $coordinates['row'] && $cell->getColumn() === $coordinates['column']) {
                return $cell;
            }
        }
        throw new \InvalidArgumentException('Cell not found');
    }
}
