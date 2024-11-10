<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    // Specify paths to the code you want Rector to analyze and refactor
    $rectorConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    // Add rules or sets you want to apply
    $rectorConfig->sets([
        SetList::PHP_81,  // Cell: Upgrade code to PHP 8.1 standards
        SetList::CODE_QUALITY,  // Code quality improvements
    ]);

    // Define autoload
    $rectorConfig->autoloadPaths([
        __DIR__ . '/vendor/autoload.php',
    ]);

    // Specify directories to exclude from refactoring (e.g., for performance)
    $rectorConfig->skip([
        __DIR__ . '/vendor',
        __DIR__ . '/storage',
    ]);
};
