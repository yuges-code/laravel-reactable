<?php

namespace Yuges\Reactable\Observers;

use Yuges\Reactable\Config\Config;
use Yuges\Reactable\Models\Reaction;

class ReactionObserver
{
    public function saving(Reaction $reaction): void
    {
        if (Config::getPermissionsAnonymous()) {
            return;
        }

        /** @todo reactor protect */
        /** @todo reactable protected */
    }

    public function deleted(Reaction $comment): void
    {

    }
}
