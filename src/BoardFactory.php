<?php

declare(strict_types=1);

namespace Taboritis\Sudoku;

class BoardFactory
{

    public static function generate(): Board
    {
        $board = new Board();

        self::fillBoard($board);
        dd($board->toArray());
        return $board;
    }

    public static function fillBoard(Board $board)
    {
        foreach ($board->getCells() as $cell) {
            $candidates = range(1, 9);
            shuffle($candidates);

            foreach ($candidates as $candidate) {
                $row = $board->getRow($cell->getRow());
                $column = $board->getColumn($cell->getColumn());
                if ($row->hasValue($candidate)) {
                    continue;
                }
                if ($column->hasValue($candidate)) {
                    continue;
                }
                $cell->setValue($candidate);
            }
        }
    }

    public static function isValid(Board $board, Cell $cell, int $valueCandidate): bool
    {
        $column = $board->getColumn($cell->getColumn());

        foreach ($column->getCells() as $cell) {
            if ($cell->getValue() == $valueCandidate) {
                return false;
            }
        }

        $row = $board->getRow($cell->getRow());

        foreach ($row->getCells() as $cell) {
            if ($cell->getValue() == $valueCandidate) {
                return false;
            }
        }

        return true;
    }
}
