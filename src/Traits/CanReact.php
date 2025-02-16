<?php

namespace Yuges\Reactable\Traits;

use Yuges\Reactable\Config\Config;
use Yuges\Reactable\Models\Reaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property Collection<int, Reaction> $reactions
 * @property ?Reaction $latestReaction
 * @property ?Reaction $oldestReaction
 */
trait CanReact
{
    public function reactions(): MorphMany
    {
        return $this->morphMany(Config::getReactionClass(), 'reactor');
    }

    public function latestReaction(): MorphOne
    {
        return $this->reactions()->one()->latestOfMany();
    }

    public function oldestReaction(): MorphOne
    {
        return $this->reactions()->one()->oldestOfMany();
    }
}
