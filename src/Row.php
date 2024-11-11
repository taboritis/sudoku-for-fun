<?php

declare(strict_types=1);

namespace Taboritis\Sudoku;

class Row
{
    /**
     * @var Cell[]
     */
    private array $cells;

    /**
     * @param Cell[] $cells
     */
    public function __construct(array $cells)
    {
        $rows = array_unique(array_map(fn(Cell $cell) => $cell->getRow(), $cells));
        $columns = array_unique(array_map(fn(Cell $cell) => $cell->getColumn(), $cells));

        if (count($rows) > 1 || count($columns) !== 9) {
            throw new \InvalidArgumentException('Cells are from different rows');
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

    public function getRowNumber(): int
    {
        return $this->cells[0]->getRow();
    }

    public function getCell(int $column): Cell
    {
        foreach ($this->cells as $cell) {
            if ($cell->getColumn() === $column) {
                return $cell;
            }
        }
        throw new \InvalidArgumentException('Cell not found');
    }
}
