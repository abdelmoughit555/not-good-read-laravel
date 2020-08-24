<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * Undocumented class
 */
final class LikeType extends Enum
{
    const comment = \App\Models\Comment::class;
    const reply = \App\Models\Reply::class;
}
