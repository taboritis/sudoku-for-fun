<?php

declare(strict_types=1);

namespace Taboritis\Sudoku;

class Column
{
    /**
     * @var Cell[]
     */
    private array $cells;

    /**
     * @param Cell[] $cells
     */
    public function __construct(array $cells = [])
    {
        $columns = array_unique(array_map(fn(Cell $cell) => $cell->getColumn(), $cells));
        $rows = array_unique(array_map(fn(Cell $cell) => $cell->getRow(), $cells));

        if (count($columns) > 1 || count($rows) !== 9) {
            throw new \InvalidArgumentException('Cells are from different columns');
        }

        $this->cells = $cells;
    }

    public function getColumnNumber(): int
    {
        return $this->cells[0]->getColumn();
    }

    public function getCell(int $row): Cell
    {
        foreach ($this->cells as $cell) {
            if ($cell->getRow() === $row) {
                return $cell;
            }
        }

        throw new \InvalidArgumentException('Cell not found');
    }

    /**
     * @return Cell[]
     */
    public function getCells(): array
    {
        return $this->cells;
    }

    public function hasValue(int $value): bool
    {
        foreach ($this->cells as $cell) {
            if ($cell->getValue() === $value) {
                return true;
            }
        }

        return false;
    }
}
