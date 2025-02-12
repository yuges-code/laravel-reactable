<?php

namespace Yuges\Reactable\Traits;

use Yuges\Reactable\Config\Config;
use Yuges\Reactable\Models\Reaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property Collection<int, Reaction> $reactions
 */
trait CanReact
{
    public function reactions(): MorphMany
    {
        return $this->morphMany(Config::getReactionClass(), 'reactor');
    }
}
