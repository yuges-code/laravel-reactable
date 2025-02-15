<?php

namespace Yuges\Reactable\Enums;

use Yuges\Reactable\Interfaces\ReactionIcon as ReactionIconInterface;

enum ReactionIcon: string implements ReactionIconInterface
{
    case Like = '👍';
    case Dislike = '👎';
}
