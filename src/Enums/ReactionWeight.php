<?php

namespace Yuges\Reactable\Enums;

use Yuges\Reactable\Interfaces\ReactionWeight as ReactionWeightInterface;

enum ReactionWeight: int implements ReactionWeightInterface
{
    case Like = 1;
    case Dislike = -1;
}
