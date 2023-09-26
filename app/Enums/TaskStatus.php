<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Open()
 * @method static static Completed()
 */
final class TaskStatus extends Enum
{
    const Open = 0;
    const Completed = 1;
}
