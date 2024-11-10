<?php

declare(strict_types=1);

namespace Taboritis\Sudoku;

class Cell
{
    private int $value = 0;

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): void
    {
        $this->value = $value;
    }

}
