<?php

namespace App\Enums\Client;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserType extends Enum
{
    const user =   'user';
    const company =   'company';
    const admin = 'admin';
    const superAdmin = 'super_admin';
}
