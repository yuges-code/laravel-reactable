<?php

namespace Yuges\Reactable\Enums;

enum ReactionType: int
{
    case Like = 1;
    case Dislike = 2;

    public function weight(): int
    {
        return match ($this) {
            self::Like => 1,
            self::Dislike => -1,
        };
    }
}
