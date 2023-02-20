<?php

declare(strict_types=1);

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * Class SearchType
 *
 * @method static self ulcerative_colitis()
 * @method static self crown()
 * @method static self hereditary_angioedema()
 * @method static self multiple_myeloma()
 * @method static self short_bowel_syndrome()
 *
 * @package App\Enums
 */
final class DiseaseType extends Enum
{
    protected static function values(): array
    {
        return [
            'ulcerative_colitis' => 'ulcerative_colitis',
            'crown' => 'crown',
            'hereditary_angioedema' => 'hereditary_angioedema',
            'multiple_myeloma' => 'multiple_myeloma',
            'short_bowel_syndrome' => 'short_bowel_syndrome',
        ];
    }

    /**
     * @return array
     */
    protected static function labels(): array
    {
        return [
            'ulcerative_colitis' => 'Язвенный колит',
            'crown' => 'Болезнь Крона',
            'hereditary_angioedema' => 'Наследственный ангиневротическицй отек',
            'multiple_myeloma' => 'Множественная миелома',
            'short_bowel_syndrome' => 'Синдром короткой кишки',
        ];
    }

}
