<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->cacheDirectory('var/cache/rector');
    $rectorConfig->parallel(240);
    $rectorConfig->paths([
        'src',
    ]);
    $rectorConfig->sets([
        \Rector\Set\ValueObject\SetList::CODE_QUALITY,
        \Rector\Set\ValueObject\SetList::PRIVATIZATION,
        \Rector\Set\ValueObject\SetList::TYPE_DECLARATION,
        \Rector\Set\ValueObject\SetList::TYPE_DECLARATION_STRICT,
        \Rector\Set\ValueObject\LevelSetList::UP_TO_PHP_74,
    ]);
};
