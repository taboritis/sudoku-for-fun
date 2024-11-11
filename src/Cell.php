<?php

declare(strict_types=1);

namespace Taboritis\Sudoku;

class Cell
{
    private int $value = 0;
    private int $row;
    private int $column;

    public function __construct(int $row, int $column, int $value = 0)
    {
        if ($row < 1 || $row > 9 || $column < 1 || $column > 9) {
            throw new \InvalidArgumentException('Invalid coordinates');
        }

        $this->row = $row;
        $this->column = $column;
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): void
    {
        $this->value = $value;
    }

    public function getRow(): int
    {
        return $this->row;
    }

    public function getColumn(): int
    {
        return $this->column;
    }

    public function numericPositionInSquare(): int
    {
        return (($this->row - 1) % 3) * 3 + (($this->column - 1) % 3) + 1;
    }
}
