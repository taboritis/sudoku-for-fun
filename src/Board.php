<?php

declare(strict_types=1);

namespace Taboritis\Sudoku;

class Board
{
    /**
     * @var Cell[]
     */
    private array $cells = [];

    /**
     * @var Row[]
     */
    private array $rows;

    /**
     * @var Column[]
     */
    private array $columns;

    /**
     * @var Square[]
     */
    private array $squares;

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

        for ($i = 1; $i <= 9; $i++) {
            $rowCells = array_filter($this->cells, fn(Cell $cell) => $cell->getRow() === $i);
            $columnCells = array_filter($this->cells, fn(Cell $cell) => $cell->getColumn() === $i);
            $squareCells = array_filter($this->cells, fn(Cell $cell) => $cell->squareNumber() === $i);
            $this->rows[$i] = new Row($rowCells);
            $this->columns[$i] = new Column($columnCells);
            $this->squares[$i] = new Square($squareCells);
        }
    }

    public function getColumn(int $columnNumber): Column
    {
        return $this->columns[$columnNumber];
    }

    public function getRow(int $rowNumber): Row
    {
        return $this->rows[$rowNumber];
    }

    public function getSquare(int $squareNumber): Square
    {
        return $this->squares[$squareNumber];
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

    public function getRows(): array
    {
        return $this->rows;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function getSquares(): array
    {
        return $this->squares;
    }
}
