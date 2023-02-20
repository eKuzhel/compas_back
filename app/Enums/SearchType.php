<?php

declare(strict_types=1);

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * Class SearchType
 *
 * @method static self adult()
 * @method static self child()
 *
 * @package App\Enums
 */
final class SearchType extends Enum
{
    protected static function values(): array
    {
        return [
            'adult' => 1,
            'child' => 2,
        ];
    }

}
