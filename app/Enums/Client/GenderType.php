<?php

namespace App\Enums\Client;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class GenderType extends Enum
{
    const male =   'male';
    const female =   'female';
}
