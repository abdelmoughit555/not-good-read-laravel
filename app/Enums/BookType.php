<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class BookType extends Enum
{
    const Read =  'read';
    const CurrentlyReading =   'currently reading';
    const WantingToRead = 'want to ream';
}
