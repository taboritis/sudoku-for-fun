<?php

declare(strict_types=1);

namespace Taboritis\Sudoku;

class SudokuBoardGenerator
{
    public static function generate(): Board
    {
        $board = new Board();

        foreach ($board->getRows() as $row) {
            do {
                $row->reset();
                SudokuBoardGenerator::fillRow($board, $row);
            } while (!$row->isFilled());
        }

        return $board;
    }

    private static function fillRow(Board $board, Row $row): void
    {
        foreach ($row->getCells() as $cell) {
            $candidates = range(1, 9);
            shuffle($candidates);
            foreach ($candidates as $candidate) {
                $row = $board->getRow($cell->getRow());
                $column = $board->getColumn($cell->getColumn());
                $square = $board->getSquare($cell->squareNumber());
                if ($row->hasValue($candidate)) {
                    continue;
                }
                if ($column->hasValue($candidate)) {
                    continue;
                }
                if ($square->hasValue($candidate)) {
                    continue;
                }
                $cell->setValue($candidate);
            }
        }
    }
}
