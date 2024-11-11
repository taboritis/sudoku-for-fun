<?php

declare(strict_types=1);

namespace Taboritis\Sudoku;

class Row
{
    private array $cells;

    public function __construct(array $cells)
    {
        $this->cells = $cells;
    }

    public function getCells(): array
    {
        return $this->cells;
    }
}
