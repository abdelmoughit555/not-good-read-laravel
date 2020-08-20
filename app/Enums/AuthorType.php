<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AuthorType extends Enum
{
    const Author = 'author';
    const Illustrator =  'illustrator';
    const Translator = 'translator';
}
