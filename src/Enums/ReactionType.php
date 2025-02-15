<?php

namespace Yuges\Reactable\Enums;

use BackedEnum;
use Yuges\Reactable\Config\Config;
use Yuges\Reactable\Interfaces\ReactionType as ReactionTypeInterface;

enum ReactionType: int implements ReactionTypeInterface
{
    case Like = 1;
    case Dislike = 2;

    public function icon(): BackedEnum
    {
        return Config::getReactionIconEnumClass()::{$this->name};
    }

    public function weight(): BackedEnum
    {
        return Config::getReactionWeightEnumClass()::{$this->name};
    }
}
