<?php

declare(strict_types=1);

namespace Taboritis\Sudoku;

class Cell
{
    private int $value = 0;
    private int $row;
    private int $column;

    public function __construct(int $row, int $column)
    {
        if ($row < 1 || $row > 9 || $column < 1 || $column > 9) {
            throw new \InvalidArgumentException('Invalid coordinates');
        }

        $this->row = $row;
        $this->column = $column;
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
}