<?php

declare(strict_types=1);

namespace Taboritis\Sudoku;

class Board
{
    /**
     * @var Cell[]
     */
    private array $cells = [];

    public function __construct()
    {
        $this->initializeBoard();
    }

    /**
     * @return Cell[]
     */
    public function getCells(): array
    {
        return $this->cells;
    }

    private function initializeBoard(): void
    {
        foreach (range(1, 9) as $row) {
            foreach (range(1, 9) as $column) {
                $this->cells[] = new Cell($row, $column);
            }
        }
    }

    public function getColumn(int $columnNumber): Column
    {
        $cells = array_filter($this->cells, fn(Cell $cell) => $cell->getColumn() === $columnNumber);

        return new Column($cells);
    }

    public function getRow(int $rowNumber): Row
    {
        $cells = array_filter($this->cells, fn(Cell $cell) => $cell->getRow() === $rowNumber);

        return new Row($cells);
    }

    public function getSquare(int $int): Square
    {
        $cells = array_filter($this->cells, fn(Cell $cell) => $cell->squareNumber() === $int);

        return new Square($cells);
    }

    public function getCell(int $row, int $column): Cell
    {
        foreach ($this->cells as $cell) {
            if ($cell->getRow() === $row && $cell->getColumn() === $column) {
                return $cell;
            }
        }

        throw new \InvalidArgumentException('Cell not found');
    }

    public function toArray(): array
    {
        $result = [];

        for ($row = 1; $row <= 9; $row++) {
            $resultRow = '';
            for ($column = 1; $column <= 9; $column++) {
                $cell = $this->getCell($row, $column);
                $value = $cell->getValue() ? $cell->getValue() : '.';
                $resultRow .= $value;
            }
            $result[] = $resultRow;
        }

        return $result;
    }
}
